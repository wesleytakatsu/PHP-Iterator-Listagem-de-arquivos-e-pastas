<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista arquivos com o Iterator</title>
</head>
<body>
    <div id="conteudo">
        <div class="centralizaImagem">
            <img src="https://wesleytakatsu.github.io/Pagina-Apresentacao-Pessoal/media/img/Logo-Takatsu-Projetos.png" alt="Logo do Wesley Takatsu">
        </div>
    <h1>Listando pastas e arquivos com PHP Iterator compatível com PHP7 e PHP8.</h1>
    <h2>Colocando arquivos dentro do mesmo diretório configurado.</h2>
    <h3>É limitado a 1 pasta de profundidade conforme colocado no exemplo.<br>
    Existe a possibilidade de criar uma função recursiva para listar uma árvore de arquivos.</h3>

    <a href="https://www.php.net/manual/en/class.directoryiterator.php" target="_blank">Manual do PHP Iterator</a>
    <br>
    <p>Os arquivos dentro dos diretórios são de exemplo e com royaties free.</p>
    <hr>
<?php
    //  MANUAL:
    //  https://www.php.net/manual/en/class.directoryiterator.php

    $pastaComArquivos = "arquivos";

    $iterator = new DirectoryIterator(__DIR__ . "\\" . $pastaComArquivos);
    echo "Caminho completo do diretório usado no Iterator:<br>" . $iterator->getPathname() . "<br><br>";

    $filePath = __FILE__;
    echo "Caminho completo do diretório com nome do arquivo:<br>" . $filePath . "<br><br>";

    $folderPath = __DIR__;
    echo "Caminho completo do diretório:<br>" . $folderPath . "<br><br>";

    //  O CONTADOR SERVE PARA PULAR OS 2 PRIMEIROS QUE SÃO OS NÍVEIS ACIMA
    //  TAMBÉM É USADO PARA MOSTRAR A QUANTIDADE DE ARQUIVOS ENCONTRADOS
    $contador = 1;
    foreach($iterator as $arquivoinfo){
        if($contador == 1){
            $arquivoinfo->next();
            $arquivoinfo->next();
        }
        echo "Arquivo número " . $contador . "<br>";
        echo "Nome do arquivo: " . $arquivoinfo->getFilename() . "<br>";
        echo "Estensão do arquivo: " . $arquivoinfo->getExtension() . "<br>";
        echo "Tamanho do arquivo (bytes): " . $arquivoinfo->getSize() . "<br>";
        echo "É um arquivo? " . $arquivoinfo->isFile() . "<br>";
        echo "É uma pasta? " . $arquivoinfo->isDir() . "<br><br>";

        //  SE O ARQUIVO FOR UMA PASTA ELE EXECUTA A LISTAGEM DENTRO DA PASTA
        if ($arquivoinfo->isDir()) {
            echo "<hr>";
            echo "LISTANDO A PASTA: " . $arquivoinfo->getFilename() . "<br><br>";
            $iteratorDentroDaPasta = new DirectoryIterator(__DIR__ . "\\" . $pastaComArquivos . "\\" . $arquivoinfo->getFilename());
            $contadorDentroDaPasta = 1;
            foreach ($iteratorDentroDaPasta as $arquivoinfoDentroDaPasta) {
                if ($contadorDentroDaPasta == 1) {
                    $arquivoinfoDentroDaPasta->next();
                    $arquivoinfoDentroDaPasta->next();
                }
                if($arquivoinfoDentroDaPasta->getFilename() != null){
                    echo "Arquivo dentro da pasta número " . $contadorDentroDaPasta . "<br>";
                    echo "Nome do arquivo: " . $arquivoinfoDentroDaPasta->getFilename() . "<br>";
                    echo "Estensão do arquivo: " . $arquivoinfoDentroDaPasta->getExtension() . "<br>";
                    echo "Tamanho do arquivo (bytes): " . $arquivoinfoDentroDaPasta->getSize() . "<br>";
                    echo "É um arquivo? " . $arquivoinfoDentroDaPasta->isFile() . "<br>";
                    echo "É uma pasta? " . $arquivoinfoDentroDaPasta->isDir() . "<br><br>";
                    $contadorDentroDaPasta++;
                }else{
                    echo "PASTA VAZIA!<br>";
                }
            }
            echo "<hr>";
        }

        $contador++;
    }
    
?>


</div>


</body>
</html>