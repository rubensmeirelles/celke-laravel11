<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request){

        //$users = User::orderBy('created_at')->paginate(10);

        $users = User::when($request->has('name'), function ($whenQuery) use ($request){
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })

        ->when($request->has('email'), function ($whenQuery) use ($request){
            $whenQuery->where('email', 'like', '%' . $request->email . '%');
        })
        ->when($request->filled('start_date_registration'), function ($whenQuery) use ($request){
            $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse
            ($request->start_date_registration)->format('Y-m-d H:i:s'));
        })
        ->when($request->filled('end_date_registration'), function ($whenQuery) use ($request){
            $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse
            ($request->end_date_registration)->format('Y-m-d H:i:s'));
        })
        ->orderBy('created_at')
        ->paginate(10)
        ->withQueryString();

        return view('users.index', [
            'users' => $users,
            'name' => $request->name,
            'email' => $request->email,
            'start_date_registration' => $request->start_date_registration,
            'end_date_registration' => $request->end_date_registration,
        ]);
    }

    public function create(){
        //Recuperar os perfis
        $roles = Role::pluck('name')->all();
        return view('users.create', ['roles' => $roles]);
    }

    public function show(User $user){
        return view('users.show', ['user' => $user]);
    }

    public function store(UserRequest $request){

        $request->validated();

        DB::beginTransaction();

        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,

            ]);

            //Cadastrar o perfil do usuário
            $user->assignRole($request->roles);

            Log::info('Usuário cadastrado', ['id' => $user->id]);

            DB::commit();

            return redirect()->route('user.index', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
        }
        catch (Exception $e) {

            Log::warning('Usuário não cadastrado', ['error' => $e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }
    public function edit(User $user)
    {
        $roles = Role::pluck('name')->all();

        //Recuperar o perfil do usuário
        $userRoles = $user->roles->pluck('name')->first();

        // Carregar a VIEW
        return view('users.edit', ['menu' => 'users', 'user' => $user, 'roles' => $roles, 'userRoles' => $userRoles]);
    }

    // Editar no banco de dados o usuário
    public function update(UserRequest $request, User $user)
    {
        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            //Editar o perfil do usuário
            $user->syncRoles($request->roles);

            // Salvar log
            Log::info('Usuário editado.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Usuário editado com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não editado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não editado!');
        }
    }

    // Carregar o formulário editar senha do usuário
    public function editPassword(User $user)
    {

        // Carregar a VIEW
        return view('users.editPassword', ['menu' => 'users', 'user' => $user]);
    }

    // Editar no banco de dados a senha do usuário
    public function updatePassword(Request $request, User $user)
    {

        // Validar o formulário
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $user->update([
                'password' => $request->password,
            ]);

            // Salvar log
            Log::info('Senha do usuário editada.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Senha do usuário editada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Senha do usuário não editada.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Senha do usuário não editada!');
        }
    }

    // Excluir o usuário do banco de dados
    public function destroy(User $user)
    {
        try {
            // Excluir o registro do banco de dados
            $user->delete();

            //Remove todos os perfis atribuídos ao usuário
            $user->syncRoles([]);

            // Salvar log
            Log::info('Usuário excluído.', ['id' => $user->id, 'action_usr_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não excluído.', ['error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('course.index')->with('error', 'Usuário não excluído!');
        }
    }

    public function generatePdf(Request $request){
        //$users = User::orderByDesc('id')->get();

        $users = User::when($request->has('name'), function ($whenQuery) use ($request){
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })

        ->when($request->has('email'), function ($whenQuery) use ($request){
            $whenQuery->where('email', 'like', '%' . $request->email . '%');
        })
        ->when($request->filled('start_date_registration'), function ($whenQuery) use ($request){
            $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse
            ($request->start_date_registration)->format('Y-m-d H:i:s'));
        })
        ->when($request->filled('end_date_registration'), function ($whenQuery) use ($request){
            $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse
            ($request->end_date_registration)->format('Y-m-d H:i:s'));
        })
        ->orderBy('created_at')
        ->get();

        //Somar o total de registros
        $totalRecords = $users->count('id');

        //Verifica se a quantida e registros ultrapassa o limite para gerar PDF
        $numberRecordAllowed = 500;

        if($totalRecords > $numberRecordAllowed){
            return redirect()->route('user.index', [
                'name' => $request->name,
                'email' => $request->email,
                'start_date_registration' => $request->start_date_registration,
                'end_date_registration' => $request->end_date_registration,
            ])->with('error', "Limite de registros ultrapassado para gerar o PDF. O limite é de $numberRecordAllowed registros!");
        }

        //Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        $pdf = PDF::loadView('users.generatePdf', ['users' => $users])->setPaper('a4', 'portrait');

        //Fazer o download
        return $pdf->download('list_users.pdf');
    }

    public function generateCsv(Request $request) {

        $users = User::when($request->has('name'), function ($whenQuery) use ($request){
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })

        ->when($request->has('email'), function ($whenQuery) use ($request){
            $whenQuery->where('email', 'like', '%' . $request->email . '%');
        })
        ->when($request->filled('start_date_registration'), function ($whenQuery) use ($request){
            $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse
            ($request->start_date_registration)->format('Y-m-d H:i:s'));
        })
        ->when($request->filled('end_date_registration'), function ($whenQuery) use ($request){
            $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse
            ($request->end_date_registration)->format('Y-m-d H:i:s'));
        })
        ->orderBy('created_at')
        ->get();

        //Somar o total de registros
        $totalRecords = $users->count('id');

        //Verifica se a quantida e registros ultrapassa o limite para gerar PDF
        $numberRecordAllowed = 500;

        if($totalRecords > $numberRecordAllowed){
            return redirect()->route('user.index', [
                'name' => $request->name,
                'email' => $request->email,
                'start_date_registration' => $request->start_date_registration,
                'end_date_registration' => $request->end_date_registration,
            ])->with('error', "Limite de registros ultrapassado para gerar o PDF. O limite é de $numberRecordAllowed registros!");
        }

        //Criar o csv
        $csvFileName = tempnam(sys_get_temp_dir(), 'csv_' .Str::ulid());

        //Abrir o arquivo para escrita
        $openFile = fopen($csvFileName, 'w');

        //Criar o cabeçalho
        $header = ['id', 'Nome', 'E-mail', 'Data de cadastro'];

        //Escrever o cabeçalho no arquivo
        fputcsv($openFile, $header, ';');

        //Ler os registros recuperados do banco
        foreach($users as $user){
            $userArraay = [
                'id' => $user->id,
                'name' => mb_convert_encoding($user->name, 'ISO-8859-1', 'UTF-8'),
                'email' => $user->email,
                'created_at' => \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s'),
            ];

            //Escrever no arquivo
            fputcsv($openFile, $userArraay, ';');
        }

        //Fechar o arquivo
        fclose($openFile);

        //Realizar o download
        $dateDownload = \Carbon\Carbon::parse(now())->format('dmY');
        return response()->download($csvFileName, 'list_users_' . $dateDownload . '.csv');

    }
}
