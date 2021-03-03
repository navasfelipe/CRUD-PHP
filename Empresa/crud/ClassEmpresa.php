<?php
class Empresa
{
    private $nome;
    private $cpfCnpj;
    private $municipio;
    private $rg;
    private $pj;
    private $dtNascimento;

    public function __construct($nome = '', $cpfCnpj = '', $municipio = '', $rg = '', $pj = '', $dtNascimento = '')
    {
        $this->nome = $nome;
        $this->cpfCnpj = $cpfCnpj;
        $this->municipio = $municipio;
        $this->rg = $rg;
        $this->pj = $pj;
        $this->dtNascimento = $dtNascimento;
    }
    public function ValidarDados()
    {
        try {
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
            if (empty($this->municipio)) {
                $erro .= ' + Município';
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
            return $validacao;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function AddEmpresa()
    {
        try {
            $pdo = Banco::conectar();
            $sqlAddEmpresa = "INSERT INTO empresas (nome, cpfCnpj, municipio, rg, dtNascimento) VALUES(?,?,?,?,?)";
            $qAddEmpresa = $pdo->prepare($sqlAddEmpresa);
            $retorno = $qAddEmpresa->execute(array($this->nome, $this->cpfCnpj, $this->municipio, $this->rg, $this->dtNascimento));
            Banco::desconectar();
            return $retorno;
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
        return "Erro ao adicionar empresa";
    }

    public function EmpresaExiste()
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlEmpresaExiste = "SELECT * FROM empresas WHERE nome LIKE ? OR cpfCnpj LIKE ?";
            $qSqlEmpresaExiste = $pdo->prepare($sqlEmpresaExiste);
            $qSqlEmpresaExiste->execute(array($this->nome, $this->cpfCnpj));
            $retornoEmpresaExiste = $qSqlEmpresaExiste->fetch(PDO::FETCH_ASSOC);
            Banco::desconectar();
            if (count($retornoEmpresaExiste) > 0) {
                return true;
            }
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
        return false;
    }
}
