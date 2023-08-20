<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\CursoDisciplina;
use App\Models\Disciplina;
use App\Models\Nota;
use App\Models\Professor;
use App\Models\User;
use App\Utils\AlunoUtil;
use App\Utils\CursoDisciplinaUtil;
use App\Utils\CursoUtil;
use App\Utils\DisciplinaUtil;
use App\Utils\ProfessorUtil;
use App\Utils\UserUtil;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private function filterUserTipo($users, $tipo)
    {
        return array_filter($users, function ($user) use ($tipo) {
            return $user->tipo == $tipo;
        });
    }



    private function randomObject($array)
    {
        $tam = sizeof($array) - 1;
        $index = rand(0, $tam);
        return isset($array[$index]) ? $array[$index]  : $array[0];
    }

    public function run(): void
    {
        $users = [];
        $cursos = [];
        $disciplinas = [];
        $cursoDisciplinas = [];

        $aux_curso_disciplina = [];
        $tam = rand(20, 30);

        $admin = User::create(UserUtil::generatorFaker("ADMINISTRADOR"));

        for ($i = 0; $i < $tam; $i++) {
            $users[] = User::create(UserUtil::generatorFaker());
            $cursos[] = Curso::create(CursoUtil::generatorFaker($admin));
            $disciplinas[] = Disciplina::create(DisciplinaUtil::generatorFaker($admin));
        }

        do {
            $curso = $this->randomObject($cursos);
            $disciplina = $this->randomObject($disciplinas);
            $join = $curso->id . "-" . $disciplina->id;
            if (!in_array($join, $aux_curso_disciplina)) {
                $aux_curso_disciplina[] = $join;
                $cursoDisciplina = CursoDisciplina::where(["curso_id"=>$curso->id, "disciplina_id"=>$disciplina->id])->first();
                if(!isset($cursoDisciplina->id)){
                    $cursoDisciplinas[] = CursoDisciplina::create(CursoDisciplinaUtil::generatorFaker($curso, $disciplina, $admin));
                }
            }
        } while (25 != sizeof($cursoDisciplinas));

        $alunosUser = $this->filterUserTipo($users, "ALUNO");
        $professoresUser = $this->filterUserTipo($users, "PROFESSOR");

        $alunos = [];
        foreach($alunosUser as $aluno){
            $curso = $this->randomObject($cursos);
            $alunos[] = Aluno::create(AlunoUtil::generatorFaker($aluno,$curso,$admin));
        }

        $professores = [];
        foreach($professoresUser as $professor){
            $cursoDisciplina = $this->randomObject($cursoDisciplinas);
            $professores[] = Professor::create(ProfessorUtil::generatorFaker($professor,$cursoDisciplina,$admin));
        }

        $cont = 0;
        do{
            $aluno = $this->randomObject($alunos);
            $cursoDisciplina = $this->randomObject($cursoDisciplinas);

            if($cursoDisciplina->curso_id == $aluno->curso_id){
                $data = [];

                $data['aluno_id'] = $aluno->id;
                $data['curso_disciplina_id'] = $cursoDisciplina->id;

                $data['nota_primeira'] = rand(0,20);
                $data['nota_segunda'] = rand(0,20);
                $data['nota_terceira'] = rand(0,20);
                $data['nota_final'] = ($data['nota_primeira']+$data['nota_segunda']+$data['nota_terceira']) / 3;
                $data['created_by'] = $data['updated_by'] = $admin->id;
                $nota = Nota::where(['curso_disciplina_id'=>$cursoDisciplina->id,'aluno_id'=>$aluno->id])->first();
                if(!isset($nota->id)){
                    Nota::create($data);
                    $cont++;
                }
            }

        }while($cont < 20);


    }
}
