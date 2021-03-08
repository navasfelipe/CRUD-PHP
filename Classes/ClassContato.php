<?php
class Contato
{
    private $contatoId;
    private $nome;
    private $empresaId;
    private $cidade;

    public function __construct($contatoId = null, $nome = '', $empresaId = null, $cidade = '')
    {
        $this->id = $contatoId;
        $this->nome = $nome;
        $this->empresaId = $empresaId;
        $this->cidade = $cidade;
    }

    public function validarDados()
    {
        $erro = "Você não preencheu o(s) campo(s): ";
        $validacao = True;
        if (empty($this->nome)) {
            $erro .= 'nome';
            $validacao = False;
        }
        if (empty($this->empresaId)) {
            $erro .= ' + empresaId';
            $validacao = False;
        }
        if (empty($this->cidade)) {
            $erro .= ' + Município';
            $validacao = False;
        }

        if ($validacao) {
            return true;
        } else {
            throw new Error($erro);
        }
    }

    public function detalheContato($id)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlContatos = "SELECT * FROM contatos where id = ?";
            $qContatos = $pdo->prepare($sqlContatos);
            $qContatos->execute(array($id));
            $linhaContatos = $qContatos->fetch(PDO::FETCH_ASSOC);
            Banco::desconectar();
            return $linhaContatos;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao listar os contatos";
    }

    public function listarContatos($empresaId)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlContatos = "SELECT * FROM contatos where empresaId = ?";
            $qContatos = $pdo->prepare($sqlContatos);
            $qContatos->execute(array($empresaId));
            $linhaContatos = $qContatos->fetchAll(PDO::FETCH_ASSOC);
            Banco::desconectar();
            return $linhaContatos;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao listar os contatos";
    }

    public function adicionarContato()
    {
        try {
            $pdo = Banco::conectar();
            $sqlAddContato = "INSERT INTO contatos (nome, empresaId, cidade, dtCadastro, dtAlteracao) VALUES(?,?,?, NOW(), NOW())";
            $qAddContato = $pdo->prepare($sqlAddContato);
            $retorno = $qAddContato->execute(array($this->nome, $this->empresaId, $this->cidade));
            Banco::desconectar();
            return $retorno;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar empresa";
    }

    public function atualizarContato($id, $nome, $cidade)
    {
        try {
            $pdo = Banco::conectar();
            $sqlAtualizarContato = "UPDATE contatos SET nome = ?, cidade = ?, dtAlteracao = NOW() WHERE id = ?";
            $qAtualizar = $pdo->prepare($sqlAtualizarContato);
            $retorno = $qAtualizar->execute(array($nome, $cidade, $id));
            Banco::desconectar();
            return $retorno;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar empresa";
    }

    public function removerContato($contatoId)
    {
        try {
            $this->removerTodosTelefonesContato($contatoId);
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM contatos where id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($contatoId));
            Banco::desconectar();
            return "Empresa excluida com sucesso";
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar empresa";
    }

    public function removerTodosContatosDaEmpresa($empresaId)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlContatos = "SELECT * FROM contatos where empresaId = ?";
            $qContatos = $pdo->prepare($sqlContatos);
            $qContatos->execute(array($empresaId));
            $linhaContatos = $qContatos->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($linhaContatos); $i++) {
                $this->removerTodosTelefonesContato($linhaContatos[$i]['id']);
                $this->removerContato($linhaContatos[$i]['id']);
            }

            Banco::desconectar();
            return "Contatos excluidos com sucesso";
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar empresa";
    }

    public function contatoExiste($nome, $empresaId)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlContatoExiste = "SELECT * FROM contatos WHERE nome LIKE ? AND empresaId = ?";
            $qSqlContatoExiste = $pdo->prepare($sqlContatoExiste);
            $qSqlContatoExiste->execute(array($nome, $empresaId));
            $retornoContatoExiste = $qSqlContatoExiste->fetch(PDO::FETCH_ASSOC);
            Banco::desconectar();
            if (!empty($retornoContatoExiste)) {
                return true;
            }
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return false;
    }

    public function adicionarTelefone($contatoId, $nrTelefone)
    {
        try {
            $pdo = Banco::conectar();
            $sqlAddTelefone = "INSERT INTO telefones (contatoId, numeroTelefone, dtCadastro) VALUES(?, ?, NOW())";
            $qAddTelefone = $pdo->prepare($sqlAddTelefone);
            $retorno = $qAddTelefone->execute(array($contatoId, $nrTelefone));
            Banco::desconectar();
            return $retorno;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar o Telefone";
    }

    public function listarTelefones($contatoId)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlTelefones = "SELECT * FROM telefones where contatoId = ?";
            $qTelefones = $pdo->prepare($sqlTelefones);
            $qTelefones->execute(array($contatoId));
            $linhaTelefones = $qTelefones->fetchAll(PDO::FETCH_ASSOC);
            Banco::desconectar();
            return $linhaTelefones;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao listar os Telefones";
    }

    public function removerTelefone($id)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM telefones where id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            Banco::desconectar();
            return "Contato excluído";
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar empresa";
    }

    public function removerTodosTelefonesContato($contatoId)
    {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM telefones where contatoId = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($contatoId));
            Banco::desconectar();
            return "Contato excluído";
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
        return "Erro ao adicionar empresa";
    }
}
