<?php
namespace Etec\TurmaAB\Model;

class Database
{
    private \PDO $conexao;

    public function __construct()
    {
        $this->conexao = new \PDO("mysql:host=localhost;dbname=LadyBlog", "root", "");
    }

    function loadUser(int $id): ?User
    {
        // Prepara a instrução SQL para buscar o usuário pelo ID
        $stmt = $this->conexao->prepare("SELECT id, nome, email, senha FROM Usuario WHERE id = :id");

        $stmt->bindValue(":id", $id);
        $stmt->execute();

        // Busca o resultado e cria um objeto User caso seja encontrado
        $resultado = $stmt->fetchObject(User::class);

        if ($resultado) {
            return $resultado; // Retorna o objeto User encontrado
        }

        // Retorna null se não encontrar o usuário
        return null;
    }

    function loadUserByEmailAndSenha(string $email, string $senha): ?User
    {
        $stmt = $this->conexao->prepare("SELECT id, nome, email, senha FROM Usuario WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        $usuario = $stmt->fetchObject(User::class);
        if ($usuario && password_verify($senha, $usuario->senha)) {
            return $usuario;
        }

        return null;
    }

    function saveUser(User $user): bool
    {
        // Acessa a propriedade "conexao" do objeto
        // ($this->conexao) e prepara a instrução SQL
        // para ser executada
        $stmt = $this->conexao->prepare("INSERT INTO Usuario (nome, email, senha) VALUES (:nome, :email, :senha)");

        // Substitui os "placeholders" pelos seus
        // respectivos valores
        $stmt->bindValue(":nome", $user->nome);
        $stmt->bindValue(":email", $user->email);
        $stmt->bindValue(":senha", $user->senha);

        // Executa o sql no banco
        return $stmt->execute();
    }

    function saveNoticia(Noticia $noticia): bool
    {
        $stmt = $this->conexao->prepare("INSERT INTO Noticia ( titulo, corpo) VALUES (:titulo, :corpo)");

        $stmt->bindValue(":titulo", $noticia->titulo);
        $stmt->bindValue(":corpo", $noticia->corpo);

        return $stmt->execute();
    }

    function atualizaNoticia(Noticia $noticia): bool
{
    $stmt = $this->conexao->prepare("UPDATE NOTICIA SET titulo=:titulo,corpo=:corpo WHERE id = :id");

    $stmt->bindValue(":titulo", $noticia->titulo);
    $stmt->bindValue(":corpo", $noticia->corpo);
    $stmt->bindValue(":id", $noticia->id);

    return $stmt->execute();
}

function deletaNoticia(Noticia $noticia): bool
{
    $stmt = $this->conexao->prepare("DELETE FROM Noticia WHERE id = :id");
    $stmt->bindValue(":id", $noticia->id); 

    return $stmt->execute(); 
}


    public function loadNoticia(int $id): ?Noticia
    {
        $stmt = $this->conexao->prepare("SELECT id, titulo, corpo FROM Noticia WHERE id = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetchObject(Noticia::class) ?: null;
    }

    public function loadNoticias(): array
    {
        $stmt = $this->conexao->prepare("SELECT id, titulo, corpo FROM Noticia");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, Noticia::class);
    }

    // Próxima aula "rotas dinâmicas"
    public function loadNoticiaById(int $id): ?Noticia
    {
        $stmt = $this->conexao->prepare("SELECT id, titulo, corpo FROM Noticia WHERE id = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetchObject(Noticia::class) ?: null;
    }

}