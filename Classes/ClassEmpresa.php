<?php
class Empresa
{
    private $id;
    private $nome;
    private $cpfCnpj;
    private $cidade;
    private $rg;
    private $pj;
    private $dtNascimento;
    private $acao;

    public function __construct($id = null, $nome = '', $cpfCnpj = '', $cidade = '', $rg = '', $pj = null, $dtNascimento = '', $acao = '')
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpfCnpj = $cpfCnpj;
        $this->cidade = $cidade;
        $this->rg = $rg;
        $this->pj = $pj;
        $this->dtNascimento = $dtNascimento;
        $this->acao = $acao;
    }

    public function validarDados()
    {
        if (!empty($this->id) && $this->acao == 'remover') {
            return true;
        } elseif (!empty($this->id) && empty($this->acao)) {
            $erro = "Necessário especificar uma ação";
            throw new Error($erro . $this->id . $this->acao);
            return false;
        } elseif (!empty($this->id) && ($this->acao != 'atualizar')) {
            $erro = "Ação não permitida - " . $this->id . $this->acao;
            throw new Error($erro);
            return false;
        }

        $erro = "Você não preencheu o(s) campo(s): ";
        $validacao = True;
        if (empty($this->nome)) {
            $erro .= 'nome';
            $validacao = False;
        }
        if (empty($this->cpfCnpj)) {
            $erro .= ' + CPF/CNPJ';
            $validacao = False;
        }
        if (empty($this->cidade)) {
            $erro .= ' + Cidade';
            $validacao = False;
        }
        if (empty($this->rg) && $this->pj == false) {
            $erro .= ' + RG';
            $validacao = False;
        }
        if (empty($this->dtNascimento) && $this->pj == false) {
            $erro .= ' + Data de Nascimento';
            $validacao = False;
        }
        if ($validacao) {
            return true;
        } else {
            throw new Error($erro);
        }
    }

    public function listarEmpresas()
    {
        try {
            $pdo = Banco::conectar();
            $sql = 'SELECT * FROM empresas ORDER BY id DESC';
            $empresas = $pdo->query($sql)->fetchAll();
            Banco::desconectar();
            return $empresas;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao selecionar as empresas";
    }

    public function detalheEmpresa($id)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlEmpresa = "SELECT * FROM empresas where id = ?";
            $qEmpresa = $pdo->prepare($sqlEmpresa);
            $qEmpresa->execute(array($id));
            $linhaEmpresa = $qEmpresa->fetch(PDO::FETCH_ASSOC);
            Banco::desconectar();
            return $linhaEmpresa;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao selecionar as empresas";
    }

    public function empresaId($nome)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlEmpresa = "SELECT * FROM empresas where nome = ?";
            $qEmpresa = $pdo->prepare($sqlEmpresa);
            $qEmpresa->execute(array($nome));
            $linhaEmpresa = $qEmpresa->fetch(PDO::FETCH_ASSOC);
            Banco::desconectar();
            return $linhaEmpresa['id'];
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao selecionar as empresas";
    }

    public function adicionarEmpresa()
    {
        try {
            $pdo = Banco::conectar();
            $sqlAddEmpresa = "INSERT INTO empresas (nome, cpfCnpj, cidade, rg, dtNascimento) VALUES(?,?,?,?,?)";
            $qAddEmpresa = $pdo->prepare($sqlAddEmpresa);
            $retorno = $qAddEmpresa->execute(array($this->nome, $this->cpfCnpj, $this->cidade, $this->rg, $this->dtNascimento));
            Banco::desconectar();
            return $retorno;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar empresa";
    }

    public function atualizarEmpresa()
    {
        try {
            $pdo = Banco::conectar();
            $sqlAddEmpresa = "UPDATE empresas SET nome = ?, cpfCnpj = ?, cidade = ?, rg = ?, dtNascimento = ? WHERE id = ?";
            $qAddEmpresa = $pdo->prepare($sqlAddEmpresa);
            $qAddEmpresa->execute(array($this->nome, $this->cpfCnpj, $this->cidade, $this->rg, $this->dtNascimento, $this->id));
            Banco::desconectar();
            return "Ok";
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar empresa";
    }

    public function removerEmpresa($id)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM empresas where id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            Banco::desconectar();
            return "Empresa excluida com sucesso";
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao remover empresa";
    }

    public function empresaExiste($nome, $cpfCnpj)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlEmpresaExiste = "SELECT * FROM empresas WHERE nome LIKE ? OR cpfCnpj LIKE ?";
            $qSqlEmpresaExiste = $pdo->prepare($sqlEmpresaExiste);
            $qSqlEmpresaExiste->execute(array($nome, $cpfCnpj));
            $retornoEmpresaExiste = $qSqlEmpresaExiste->fetch(PDO::FETCH_ASSOC);
            Banco::desconectar();
            if (!empty($retornoEmpresaExiste)) {
                return true;
            }
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return false;
    }

    public function buscaEmpresa($busca)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sqlEmpresaExiste = "SELECT * FROM empresas WHERE nome LIKE ? OR cpfCnpj LIKE ?";
        //echo $sqlEmpresaExiste;
        $dados = $pdo->prepare($sqlEmpresaExiste);
        $dados->execute(array("%$busca%", "%$busca%"));
        $retorno = $dados->fetchAll();
        $linhasNome = array();
        foreach ($retorno as $linha) {
            $linhasNome[] = $linha['nome'];
        }
        echo json_encode($linhasNome);
        Banco::desconectar();
    }
}
