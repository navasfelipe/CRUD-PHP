CREATE TABLE `contatos` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `empresaId` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dtNascimento` datetime NOT NULL,
  `dtCadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `empresas` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cpfCnpj` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dtNascimento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `telefones` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `contatoId` int(11) NOT NULL,
  `numeroTelefone` int(11) NOT NULL,
  `dtCadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;