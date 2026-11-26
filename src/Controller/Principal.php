<?php
namespace Etec\TurmaAB\Controller;

use Etec\TurmaAB\Model\Database;
use Etec\TurmaAB\Model\User;

class Principal
{
    private \Twig\Environment $ambiente;
    private \Twig\Loader\FilesystemLoader $carregador;

    public function __construct()
    {
        // Construtor da classe
        $this->carregador =
            new \Twig\Loader\FilesystemLoader("./src/View");

        // Combina os dados com o template
        $this->ambiente =
            new \Twig\Environment($this->carregador);
    }


    public function paginaPrincipal(array $dados)
    {
        $dados["titulo"] = "LadyBlog";
        $dados["conteudo"] = "Fique por dentro das últimas notícias sobre Ladybug e Cat Noir!";
        $dados["noticias"] = [
            [
                "data" => "16 de Setembro de 2025",
                "titulo" => "Ladybug e Cat Noir salvam Paris novamente!",
                "conteudo" => "Na noite passada, os cidadãos de Paris testemunharam mais uma impressionante demonstração de coragem da dupla heroica Ladybug e Cat Noir. O vilão akumatizado, conhecido apenas como Shadow Painter, espalhou terror pelas ruas ao usar seus pincéis mágicos para aprisionar pessoas dentro de pinturas vivas.\n\nTestemunhas relatam que, por um momento, a situação parecia fora de controle: monumentos inteiros da cidade foram cobertos por desenhos sombrios e ameaçadores. Foi então que Ladybug entrou em ação, com sua determinação habitual. Ao lado de Cat Noir, ela enfrentou de frente as armadilhas do vilão e, com estratégias rápidas, conseguiu desviar dos ataques artísticos.\n\nA luta terminou quando Ladybug utilizou seu Lucky Charm, uma simples tesoura escolar, para cortar a tela amaldiçoada que dava poder ao akumatizado. Com isso, o objeto foi purificado e Paris voltou ao normal.\n\nMais uma vez, Ladybug demonstrou que, além de força e habilidade, sua criatividade é a chave para a vitória."
            ],
            [
                "data" => "15 de Setembro de 2025",
                "titulo" => "Quem é Ladybug por trás da máscara?",
                "conteudo" => "Apesar de salvar Paris inúmeras vezes, Ladybug continua sendo um enigma. Quem seria a jovem por trás do traje vermelho com bolinhas pretas? Rumores circulam entre estudantes e moradores da cidade.\n\nAlguns acreditam que ela seja uma estudante comum, talvez até da escola Françoise Dupont, já que Ladybug costuma aparecer em áreas próximas à região. Há também teorias de que ela seja filha de algum importante político ou até mesmo uma celebridade escondendo sua identidade.\n\nPesquisadores amadores analisaram vídeos de suas batalhas e apontaram semelhanças na postura e na voz com algumas adolescentes conhecidas em Paris. Porém, nada foi confirmado. Enquanto a cidade especula, Ladybug mantém sua maior arma: o mistério."
            ],
            [
                "data" => "14 de Setembro de 2025",
                "titulo" => "Cat Noir conquista fãs com seu charme!",
                "conteudo" => "Durante a última luta contra um akumatizado no centro da cidade, Cat Noir não deixou de fazer piadinhas, mesmo em meio ao caos. Vídeos de sua luta viralizaram nas redes sociais, onde seu bom humor foi destaque.\n\n\"Ele é um herói e um comediante ao mesmo tempo!\", comentou uma moradora que presenciou a cena. Em um dos vídeos mais compartilhados, Cat Noir aparece desviando de um ataque e logo em seguida brinca: 'Você vai ter que fazer melhor que isso!'. O público caiu na risada.\n\nEspecialistas em mídia destacam que esse carisma faz com que a população se sinta mais segura, mesmo em momentos de crise. Além disso, seu jeito descontraído contrasta perfeitamente com a seriedade e foco de Ladybug, criando um equilíbrio na dupla que já se tornou amado pelos parisienses."
            ]
        ];


        // Renderiza a view principal
        echo $this->ambiente->render("principal.html", $dados);
    }

    public function sobre(array $dados)
    {
        $dados["titulo"] = "Sobre nós";
        $dados["conteudo"] = "Conheça as desenvolvedoras por trás deste noticiário cheio de novidades! ";

         $dados["desenvolvedoras"] = [
        [
            "nome" => "Evelyn Victor",
            "foto" => "src/view/fotos/Shadybug.jpg"
        ],
        [
            "nome" => "Giovana Bandeira",
            "foto" => "src/view/fotos/Mayura.jpg"
        ],
        [
            "nome" => "Julia dos Santos",
            "foto" => "src/view/fotos/Purpletigress.jpg"
        ],
        [
            "nome" => "Laís Calafange",
            "foto" => "src/view/fotos/Renarouge.jpg"
        ]
    ];

        $dados["informação"] = "Seja bem-vindo ao nosso Ladyblog! Nossa missão é trazer para você as notícias mais quentes, curiosidades e histórias secretas da cidade. Com um olhar atento e cheio de energia, queremos que você se divirta, se informe e se inspire a descobrir cada detalhe que faz nosso mundo tão especial. Prepare-se para ficar por dentro de tudo!"; 

        // Renderiza a view sobre
        echo $this->ambiente->render("sobre.html", $dados);
    }

}

