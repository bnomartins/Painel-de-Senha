-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/08/2023 às 21:30
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `larinvue`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `procedimento_grupos`
--

CREATE TABLE `procedimento_grupos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grupo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `disponivel` tinyint(1) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `procedimento_grupos`
--

INSERT INTO `procedimento_grupos` (`id`, `grupo`, `descricao`, `disponivel`, `user_id`, `created_at`, `updated_at`) VALUES
(67, '01.01', 'Ações coletivas/individuais em saúde', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(68, '01.02', 'Vigilância em saúde', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(69, '02.01', 'Coleta de material', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(70, '02.02', 'Diagnóstico em laboratório clínico', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(71, '02.03', 'Diagnóstico por anatomia patológica e citopatologia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(72, '02.04', 'Diagnóstico por radiologia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(73, '02.05', 'Diagnóstico por ultrasonografia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(74, '02.06', 'Diagnóstico por tomografia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(75, '02.07', 'Diagnóstico por ressonância magnética', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(76, '02.08', 'Diagnóstico por medicina nuclear in vivo', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(77, '02.09', 'Diagnóstico por endoscopia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(78, '02.10', 'Diagnóstico por radiologia intervencionista', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(79, '02.11', 'Métodos diagnósticos em especialidades', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(80, '02.12', 'Diagnóstico e procedimentos especiais em hemoterapia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(81, '02.13', 'Diagnóstico em vigilância epidemiológica e ambiental', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(82, '02.14', 'Diagnóstico por teste rápido', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(83, '03.01', 'Consultas / Atendimentos / Acompanhamentos', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(84, '03.02', 'Fisioterapia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(85, '03.03', 'Tratamentos clínicos (outras especialidades)', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(86, '03.04', 'Tratamento em oncologia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(87, '03.05', 'Tratamento em nefrologia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(88, '03.06', 'Hemoterapia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(89, '03.07', 'Tratamentos odontológicos', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(90, '03.08', 'Tratamento de lesões, envenenamentos e outros, decorrentes de causas externas', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(91, '03.09', 'Terapias especializadas', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(92, '03.10', 'Parto e nascimento', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(93, '04.01', 'Pequenas cirurgias e cirurgias de pele, tecido subcutâneo e mucosa', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(94, '04.02', 'Cirurgia de glândulas endócrinas', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(95, '04.03', 'Cirurgia do sistema nervoso central e periférico', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(96, '04.04', 'Cirurgia das vias aéreas superiores, da face, da cabeça e do pescoço', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(97, '04.05', 'Cirurgia do aparelho da visão', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(98, '04.06', 'Cirurgia do aparelho circulatório', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(99, '04.07', 'Cirurgia do aparelho digestivo, orgãos anexos e parede abdominal', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(100, '04.08', 'Cirurgia do sistema osteomuscular', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(101, '04.09', 'Cirurgia do aparelho geniturinário', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(102, '04.10', 'Cirurgia de mama', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(103, '04.11', 'Cirurgia obstétrica', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(104, '04.12', 'Cirurgia torácica', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(105, '04.13', 'Cirurgia reparadora', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(106, '04.14', 'Bucomaxilofacial', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(107, '04.15', 'Outras cirurgias', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(108, '04.16', 'Cirurgia em oncologia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(109, '04.17', 'Anestesiologia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(110, '04.18', 'Cirurgia em nefrologia', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(111, '05.01', 'Coleta e exames para fins de doação de orgãos, tecidos e células e de transplante', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(112, '05.02', 'Avaliação de morte encefálica', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(113, '05.03', 'Ações relacionadas à doação de orgãos e tecidos para transplante', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(114, '05.04', 'Processamento de tecidos para transplante', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(115, '05.05', 'Transplante de orgãos, tecidos e células', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(116, '05.06', 'Acompanhamento e intercorrências no pré e pós-transplante', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(117, '06.01', 'Medicamentos de dispensação excepcional', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(118, '06.02', 'Medicamentos estratégicos', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(119, '06.03', 'Medicamentos de âmbito hospitalar e urgência', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(120, '06.04', 'Componente Especializado da Assitencia Farmaceutica', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(121, '07.01', 'Órteses, próteses e materiais especiais não relacionados ao ato cirúrgico', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(122, '07.02', 'Órteses, próteses e materiais especiais relacionados ao ato cirúrgico', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(123, '08.01', 'Ações relacionadas ao estabelecimento', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(124, '08.02', 'Ações relacionadas ao atendimento', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18'),
(125, '08.03', 'Autorização / Regulação', 1, 1, '2023-08-18 21:50:18', '2023-08-18 21:50:18');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `procedimento_grupos`
--
ALTER TABLE `procedimento_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `procedimento_grupos_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `procedimento_grupos`
--
ALTER TABLE `procedimento_grupos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `procedimento_grupos`
--
ALTER TABLE `procedimento_grupos`
  ADD CONSTRAINT `procedimento_grupos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
