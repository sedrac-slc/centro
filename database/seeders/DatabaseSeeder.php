<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\User;
use App\Utils\CursoUtil;
use App\Utils\DisciplinaUtil;
use App\Utils\UserUtil;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private function filterUserTipo($users, $tipo) {
        return array_filter($users, function($user) use ($tipo) {
            return $user->tipo == $tipo;
        });
    }

    private function storeObject($obj, $tipo, $user){
        return $obj.$tipo.$user;
    }

    private function storeArrayObject($array, $tipo, $user){
        $objs = [];
        foreach($array as $obj){
            $objs[] = $this->storeObject($obj, $tipo, $user);
        }
        return $objs;
    }

    private function randomObject($array){
        $index = rand(0, sizeof($array) - 1);
        return $array[$index];
    }

    public function run(): void
    {
        $users = [];
        $cursos = [];
        $disciplinas = [];
        $tam = rand(20, 30);

        $admin = User::create(UserUtil::generatorFaker("ADMINISTRADOR"));

        for($i=0; $i < $tam; $i++){
            $users[] = User::create(UserUtil::generatorFaker());
            $cursos[] = Curso::create(CursoUtil::generatorFaker($admin));
            $disciplinas[] = Disciplina::create(DisciplinaUtil::generatorFaker($admin));
        }

        $alunos = $this->filterUserTipo($users,"ALUNO");
        $professores = $this->filterUserTipo($users,"PROFESSOR");
        $administradores = $this->filterUserTipo($users, "ADMINISTRADOR");

        $this->storeArrayObject($alunos,"ALUNO",$this->randomObject($administradores));

        $this->storeArrayObject($professores,"PROFESSOR",$this->randomObject($administradores));

    }

}
