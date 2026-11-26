<?php
namespace Etec\TurmaAB\Controller;

use Etec\TurmaAB\Model\User;
use Etec\TurmaAB\Model\Noticia;
use Etec\TurmaAB\Model\Database;

class Admin
{
    private \Twig\Environment $ambiente;
    private \Twig\Loader\FilesystemLoader $carregador;

    public function __construct()
    {
        // Inicia a sessão
        // Verifica se o usuário está logado
        // Se não estiver, redireciona para a página de login
        session_start();
        if (!isset($_SESSION["usuario"])) {
            header("Location: /login");
            exit;
        }

        // Construtor da classe
        $this->carregador =
            new \Twig\Loader\FilesystemLoader("./src/View");

        // Combina os dados com o template
        $this->ambiente =
            new \Twig\Environment($this->carregador);
    }

    /**
     * Exibe o formulário para criação de um novo produto
     * @param array $dados
     * @return void
     */
    public function formularioNovaNoticia(array $dados)
    {
        echo $this->ambiente->render("formularioNovaNoticia.html", $dados);
    }

    public function formularioAtualizaNoticia(array $dados)
    {
        echo $this->ambiente->render("formularioAtualizaNoticia.html", $dados);
    }

    public function formularioDeletaNoticia(array $dados)
    {
        echo $this->ambiente->render("formularioDeletaNoticia.html", $dados);
    }

    /**
     * Salva um novo produto
     * @param array $dados
     * @return void
     */
    public function salvaNoticia(array $dados)
    {
        $titulo = trim($dados["titulo"]);
        $corpo = $dados["corpo"];

        $avisos = "";

        if ($titulo != "" || $corpo != "") {
            $noticia = new Noticia();
            $noticia->titulo = $titulo;
            $noticia->corpo = $corpo;

            $bd = new Database();
            if ($bd->saveNoticia($noticia)) {
                // Avisa que deu certo
                $avisos .= "Notícia cadastrada com sucesso.";
            } else {
                // Avisa que deu errado
                $avisos .= "Erro ao cadastrar notícia.";
            }
        }

        $dados["avisos"] = $avisos;
        echo $this->ambiente->render("formularioNovaNoticia.html", $dados);
    }


    public function updateNoticia(array $dados)
    {
        $id = trim($dados["id"]);
        $titulo = trim($dados["titulo"]);
        $corpo = $dados["corpo"];

        $avisos = "";

        if ($titulo != "" && $corpo != "" && $id != "") {
            $noticia = new Noticia();
            $noticia->id = $id;
            $noticia->titulo = $titulo;
            $noticia->corpo = $corpo;

            $bd = new Database();
            if ($bd->atualizaNoticia($noticia)) {
                // Avisa que deu certo
                $avisos .= "Notícia atualizada com sucesso.";
            } else {
                // Avisa que deu errado
                $avisos .= "Erro ao atualizar notícia.";
            }
        }

        $dados["avisos"] = $avisos;
        echo $this->ambiente->render("formularioAtualizaNoticia.html", $dados);
    }


    public function deleteNoticia(array $dados)
{
    $id = trim($dados["id"]);
    $avisos = "";

    if ($id != "") {
        $noticia = new Noticia();
        $noticia->id = $id;

        $bd = new Database();
        if ($bd->deletaNoticia($noticia)) {
            $avisos = "Notícia deletada com sucesso.";
        } else {
            $avisos = "Erro ao deletar notícia.";
        }
    }

    echo $this->ambiente->render("formularioDeletaNoticia.html", ["avisos" => $avisos]);
}


    public function listaNoticias(array $dados)
    {
        $bd = new Database();
        $noticias = $bd->loadNoticias();

        echo $this->ambiente->render("noticias.html", ["noticias" => $noticias]);
    }

    // Próxima aula "rotas dinâmicas"
    public function mostraNoticia(array $dados)
    {
        $id = $dados["id"];

        $bd = new Database();
        $noticia = $bd->loadNoticiaById($id);

        if ($noticia) {
            echo $this->ambiente->render("mostraNoticia.html", ["noticia" => $noticia]);
        } else {
            echo $this->ambiente->render("mostraNoticia.html", ["erro" => "Noticia não encontrada."]);
        }
    }
}