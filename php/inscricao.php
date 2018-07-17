<?php

$status = "GET";

$firstname = "";
$validfirstname = false;
$errfirstname = "";

$secondname = "";
$validsecondname = false;
$errsecondname = "";

$rg = "";
$validrg = false;
$errrg = "";

$cpf = "";
$validcpf = false;
$errcpf = "";

$cep = "";
$validcep = false;
$errcep = "";

$street = "";
$validstreet = false;
$errstreet = "";

function validate_input($data) {
    $data = trim($data);
    # $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function printVar($name,$value) {
    return "<p>" . $name . ":" . validate_input($value) . "</p>";
}

function verifycpf($cpf) {
    if(strlen($cpf) == 11 and
    $cpf != '00000000000' and
    $cpf != '11111111111' and
    $cpf != '22222222222' and
    $cpf != '33333333333' and
    $cpf != '44444444444' and
    $cpf != '55555555555' and
    $cpf != '66666666666' and
    $cpf != '77777777777' and
    $cpf != '88888888888' and
    $cpf != '99999999999') {
        $d1 = 0;
        for ($i=8; $i >= 0; $i--) {
            $d1 += $cpf{$i} * ($i + 1);
        }
        $d1 = ($d1 % 11) % 10;
        $d2 = 0;
        for ($i=8; $i >= 0; $i--) {
            $d2 += $cpf{$i} * ($i);
        }
        $d2 = (($d2 + ($d1 * 9)) % 11) % 10;
        if ($cpf{9} == $d1 and $cpf{10} == $d2) {
            return true;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = "POST";
    $firstname = validate_input($_POST["firstname"]);
    if(is_string($firstname) and $firstname != "") {
        $validfirstname = true;
    } else {
        $errfirstname = "Primeiro nome em branco.";
    }
    $secondname = validate_input($_POST["secondname"]);
    if(is_string($secondname) and $secondname != "") {
        $validsecondname = true;
    } else {
        $errsecondname = "Segundo nome em branco.";
    }
    $rg = validate_input($_POST["rg"]);
    if(is_string($rg) and $rg != "") {
        $validrg = true;
    } else {
        $errrg = "RG inválido.";
    }
    $cpf = validate_input($_POST["cpf"]);
    if(is_string($cpf) and $cpf != "" and !(preg_match("/[^0123456789]/", $cpf)) and verifycpf($cpf)) {
        $validcpf = true;
    } else {
        $errcpf = "CPF inválido.";
    }
    $cep = validate_input($_POST["cep"]);
    if(is_string($cep) and $cep != "" and !(preg_match("/[^0123456789]/", $cep)) and strlen($cep) == 8) {
        $validcep = true;
    } else {
        $errcep = "CEP inválido.";
    }
    $street = validate_input($_POST["street"]);
    if(is_string($street) and $street != "") {
        $validstreet = true;
    } else {
        $errstreet = "Logradouro em branco.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="inscricao.css"/>
    <title>Inscrição</title>
</head>
<body>
<?php
echo $status;
?>
<form method="post" action="inscricao.php" enctype="multipart/form-data">
    <h1>Inscrição</h1>
    <p class="error">* campo obrigatório</p>
    <h2>Dados do responsável</h2>
    <p>Primeiro nome (ex: João):</p>
    <input type="text" name="firstname" value="<?php echo $firstname;?>"/>
    <p class="error">* <?php echo $errfirstname; ?></p>
    <p>Segundo nome (ex: Silveira Silva):</p>
    <input type="text" name="secondname" value="<?php echo $secondname;?>"/>
    <p class="error">* <?php echo $errsecondname; ?></p>
    <p>RG ou RNE (ex: 00.000.000-0):</p>
    <input type="text" name="rg" value="<?php echo $rg?>"/>
    <p class="error">* <?php echo $errrg; ?></p>
    <p>CPF (somente números):</p>
    <input type="text" name="cpf" value="<?php echo $cpf?>"/>
    <p class="error">* <?php echo $errcpf; ?></p>
    <h3>Endereço:</h3>
    <p>CEP (somente números):</p>
    <input type="text" name="cep" value="<?php echo $cep?>"/>
    <p class="error">* <?php echo $errcep; ?></p>
    <p>Logradouro:</p>
    <input type="text" name="street" value="<?php echo $street?>"/>
    <p class="error">* <?php echo $errstreet; ?></p>
    <p>Número:</p>
    <input type="text" name="number"/>
    <p class="error"></p>
    <p>Complemento:</p>
    <input type="text" name="street2"/>
    <p class="error"></p>
    <p>Bairro:</p>
    <input type="text" name="area"/>
    <p class="error"></p>
    <p>Cidade:</p>
    <input type="text" name="city"/>
    <p class="error"></p>
    <p>Estado:</p>
    <select name="state">
        <option value="AC">AC</option>
        <option value="AL">AL</option>
        <option value="AP">AP</option>
        <option value="AM">AM</option>
        <option value="BA">BA</option>
        <option value="CE">CE</option>
        <option value="DF">DF</option>
        <option value="ES">ES</option>
        <option value="GO">GO</option>
        <option value="MA">MA</option>
        <option value="MT">MT</option>
        <option value="MS">MS</option>
        <option value="MG">MG</option>
        <option value="PA">PA</option>
        <option value="PB">PB</option>
        <option value="PR">PR</option>
        <option value="PE">PE</option>
        <option value="PI">PI</option>
        <option value="RJ">RJ</option>
        <option value="RN">RN</option>
        <option value="RS">RS</option>
        <option value="RO">RO</option>
        <option value="RR">RR</option>
        <option value="SC">SC</option>
        <option value="SP">SP</option>
        <option value="SE">SE</option>
        <option value="TO">TO</option>
    </select>
    <p class="error"></p>
    <h3>Contato:</h3>
    <p>E-mail:</p>
    <input type="text" name="email"/>
    <p class="error"></p>
    <p>Repetir e-mail:</p>
    <input type="text" name="emailverify"/>
    <p class="error"></p>
    <p>Telefone principal:</p>
    (0<input type="text" class="ddd" name="ddd1"/>)
    <input type="text" name="phone1"/>
    <p class="error"></p>
    <p>Telefone secundário:</p>
    (0<input type="text" class="ddd" name="ddd2"/>)
    <input type="text" name="phone2"/>
    <p class="error"></p>
    <p>Cargo:</p>
    <input type="text" name="role"/>
    <p class="error"></p>
    <p>Formação Acadêmica:</p>
    <input type="text" name="degree"/>
    <p class="error"></p>
    <h3>Comprovante de Docência</h3>
    <p>Documento no formato PDF com tamanho máximo de 10MB</p>
    <input type="file" name="pdfdocument"/>
    <p class="error"></p>
    <h2>Dados da Instituição</h2>
    <p>Nome da instituição:</p>
    <input type="text" name="institution"/>
    <p class="error"></p>
    <p>Unidade administrativa:</p>
    <input type="text" name="unity"/>
    <p class="error"></p>
    <h2>Dados do Projeto</h2>
    <p>Categoria do projeto:</p>
    <select name="category">
        <option value="EI">Educação Infantil</option>
        <option value="EFI">Educação Fundamental I</option>
        <option value="EFII">Educação Fundamental II</option>
        <option value="EM">Ensino Médio</option>
        <option value="EJA">Educação de Jovens e Adultos</option>
        <option value="ES">Ensino Superior</option>
        <option value="XA">Xadrez</option>
        <option value="HI">Hipnoterapia</option>
    </select>
    <p class="error"></p>
    <p>Tema do projeto:</p>
    <input type="text" name="theme"/>
    <p class="error"></p>
    <p>Título da iniciativa:</p>
    <input type="text" name="title"/>
    <p class="error"></p>
    <p>Data da implatação:</p>
    <span class="observation">A iniciativa deve ter no máximo 1 (um) ano de implantação, estar em implantação.</span><br/>
    <input type="date" name="date"/>
    <p class="error"></p>
    <p>Link do video ou reportagem sobre o projeto:</p>
    <input type="text" name="video"/>
    <p class="error"></p>
    <h3>Resumo da Iniciativa:</h3>
    <span class="observation">Resumo da iniciativa com no máximo 250 palavras em parágrafo único e citando a criatividade e inovação visadas pela iniciativa.</span><br/>
    <textarea id="summary" type="text" name="summary" rows="25" cols="60" onkeyup="wordcount();"></textarea><br/>
    <span id="count"></span>
    <p class="error"></p>
    <p>Integrantes da equipe de desenvolvimento da iniciativa (caso haja)</p>
    <input type="hidden" name="memberscounter" id="memberscounter" value="1"/>
    <div class="members" id="members">
    </div>
    <button type="button" onclick="addmember();">Adicionar integrante</button>
    <p>Parceiros da iniciativa (caso haja)</p>
    <span class="observation">Órgãos, instituições e/ou entidades parceiras no desenvolvimento da iniciativa.</span><br/>
    <input type="hidden" name="partnerscounter" id="partnerscounter" value="1"/>
    <div class="partners" id="partners">
    </div>
    <button type="button" onclick="addpartner();">Adicionar parceiro</button>
    <p>Ao marcar a caixa a seguir, afirmo que li a Portaria que dispõe sobre o Concurso Cultural Prêmio Instituto Criativo de Educação, Criatividade e Inovação, a que estabelece procedimentos para as inscrições e apresentação dos trabalhos no Concurso Cultural Prêmio de Educação, Criatividade e Inovação – 2018 e todas as instruções para o preenchimento da Ficha de Inscrição e do Relato da Iniciativa. Estou ciente das regras estabelecidas e sou inteiramente responsável pelas informações prestadas.
    <input type="checkbox" name="agree" value="1"/></p>
    <input type="submit" value="Finalizar inscrição"/>
</form>
<script>
const wordcount = () => {
    const text = document.querySelector("#summary");
    const count = document.querySelector("#count");
    count.innerText = text.innerHTML.replace(/[^A-Z0-9ãõçâêôáéíóúàü]/ig, " ").trim().split(/\s+/).length;
};
const addmember = (Name, Role, CPF) => {
    Name = (Name)?String(Name):String();
    Role = (Role)?String(Role):String();
    CPF = (CPF)?String(CPF):String();
    const field = document.querySelector("#members");
    const counter = document.querySelector("#memberscounter");
    const n = Number(counter.value);
    counter.value = String(n + 1);
    field.innerHTML = field.innerHTML + `<p>Nome</p><input type="text" name="member${n}" value="${Name}"/><p>Cargo</p><input type="text" name="memberRole${n}" value="${Role}"/><p>CPF</p><input type="text" name="memberCPF${n}" value="${CPF}"/>`;
};
const addpartner = (Name) => {
    Name = (Name)?String(Name):String();
    const field = document.querySelector("#partners");
    const counter = document.querySelector("#partnerscounter");
    const n = Number(counter.value);
    counter.value = String(n + 1);
    field.innerHTML = field.innerHTML + `<p>Nome</p><input type="text" name="partner${n}" value="${Name}"/>`;
};
</script>
</body>
</html>