<?php 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\User;
use App\Models\Pessoas;

class UsersImport implements ToModel, WithChunkReading
{
    public function model(array $row)
    {
        // Processar usuários
        $user = User::updateOrCreate(
            ['email' => $row[12]], 
            [
                'nickname' => $row[1],
                'level' => 3,
                'password' => bcrypt($row[29] ?? 'insat')
            ]
        );

        // Processar dados de Pessoas
        if ($user) {
            Pessoas::updateOrCreate(
                ['user_id' => $user->id],
                ['nome' => $row[1]]
            );
        }
    }

    public function chunkSize(): int
    {
        return 100; // Processar 100 linhas por vez
    }
}
