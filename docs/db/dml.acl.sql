--
-- acl inserts
--

--
-- Roles
---
INSERT INTO saa.acl_roles (id, role, parent) VALUES (1, 'visitante', NULL);
INSERT INTO saa.acl_roles (id, role, parent) VALUES (2, 'usuario', 1);
INSERT INTO saa.acl_roles (id, role, parent) VALUES (3, 'admin', 2);
INSERT INTO saa.acl_roles (id, role, parent) VALUES (4, 'psicologo', 2);
INSERT INTO saa.acl_roles (id, role, parent) VALUES (5, 'pedagogo', 2);

--
-- Modules
--
INSERT INTO saa.acl_modules(id, module) VALUES (1, 'Application');
INSERT INTO saa.acl_modules(id, module) VALUES (2, 'ZFTool');
INSERT INTO saa.acl_modules(id, module) VALUES (3, 'Psicologia');
INSERT INTO saa.acl_modules(id, module) VALUES (4, 'Pedagogia');
INSERT INTO saa.acl_modules(id, module) VALUES (5, 'Admin');

--
-- Controllers
--
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 1, 'Index');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 2, 'Auth');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 3, 'Usuario');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 4, 'Module');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 5, 'Create');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 6, 'Profissao');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 7, 'Acompanhamento');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 8, 'AcompanhamentoIndividual');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 9, 'Aluno');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 10, 'Agendamento');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 11, 'Servidor');
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 12, 'Cargo');

--
-- Actions
--
INSERT INTO saa.acl_actions(id, action) VALUES (  1, 'index');
INSERT INTO saa.acl_actions(id, action) VALUES (  2, 'about');
INSERT INTO saa.acl_actions(id, action) VALUES (  3, 'login');
INSERT INTO saa.acl_actions(id, action) VALUES (  4, 'logout');
INSERT INTO saa.acl_actions(id, action) VALUES (  5, 'criar');
INSERT INTO saa.acl_actions(id, action) VALUES (  6, 'editar');
INSERT INTO saa.acl_actions(id, action) VALUES (  7, 'deletar');
INSERT INTO saa.acl_actions(id, action) VALUES (  8, 'editar-senha');
--INSERT INTO saa.acl_actions(id, action) VALUES (  9, 'limpar-cache-acl');
INSERT INTO saa.acl_actions(id, action) VALUES ( 10, 'permissao-negada');
INSERT INTO saa.acl_actions(id, action) VALUES ( 11, 'list');
INSERT INTO saa.acl_actions(id, action) VALUES ( 12, 'module');
INSERT INTO saa.acl_actions(id, action) VALUES ( 13, 'controller');
INSERT INTO saa.acl_actions(id, action) VALUES ( 14, 'ajax-buscar-aluno');
INSERT INTO saa.acl_actions(id, action) VALUES ( 15, 'detalhes');
INSERT INTO saa.acl_actions(id, action) VALUES ( 16, 'ajax-salvar');
INSERT INTO saa.acl_actions(id, action) VALUES ( 17, 'ajax-buscar-curso');
INSERT INTO saa.acl_actions(id, action) VALUES ( 18, 'criar-acompanhamento-agendado');


--
-- Resources
--
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  1, 1,  1,  1);--index/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  2, 1,  1,  2);--index/about
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  3, 1,  2,  3);--auth/login
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  4, 1,  2,  4);--auth/logout
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  5, 1,  3,  6);--usuario/editar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  6, 1,  3,  8);--usuario/editar-senha
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  7, 1,  3,  1);--usuario/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  8, 1,  3,  5);--usuario/criar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES (  9, 1,  3,  7);--usuario/deletar
--INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 10, 1,  2, 9);--auth/limpar-cache-acl
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 11, 1,  2, 10);--auth/permissao-negada
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 12, 2,  4, 11);--zftool/module/list
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 13, 2,  5, 12);--zftool/create/module
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 14, 2,  5, 13);--zftool/create/controller
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 15, 5,  1,  1);--admin/index/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 16, 5,  6,  1);--admin/profissao/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 17, 5,  6,  5);--admin/profissao/criar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 18, 5,  6,  6);--admin/profissao/editar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 19, 5,  6,  7);--admin/profissao/deletar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 20, 3,  1,  1);--psicologia/index/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 21, 3,  7,  1);--psicologia/acompanhamento/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 22, 3,  7,  5);--psicologia/acompanhamento/criar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 23, 3,  7, 14);--psicologia/acompanhamento/ajax-buscar-aluno
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 24, 3,  7, 15);--psicologia/acompanhamento/detalhes
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 25, 3,  8,  5);--psicologia/acompanhamento-individual/criar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 26, 3,  8,  6);--psicologia/acompanhamento-individual/editar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 27, 3,  8, 16);--psicologia/acompanhamento-individual/ajax-salvar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 28, 1,  9,  1);--aluno/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 29, 1,  9,  5);--aluno/criar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 30, 1,  9,  6);--aluno/editar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 31, 1,  9,  7);--aluno/deletar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 32, 1,  9, 17);--aluno/ajax-buscar-curso
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 33, 3, 10,  1);--psicologia/acompanhamento/agendamento/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 34, 3, 10,  5);--psicologia/acompanhamento/agendamento/criar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 35, 3, 10,  6);--psicologia/acompanhamento/agendamento/editar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 36, 3, 10,  7);--psicologia/acompanhamento/agendamento/deletar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 37, 5, 11,  1);--admin/servidor/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 38, 5, 11,  5);--admin/servidor/criar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 39, 5, 11,  6);--admin/servidor/editar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 40, 5, 11,  7);--admin/servidor/deletar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 41, 3, 10,  18);--psicologia/acompanhamento/agendamento/criar-acompanhamento-agendado
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 42, 5, 12,  1);--admin/cargo/index
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 43, 5, 12,  5);--admin/cargo/criar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 44, 5, 12,  6);--admin/cargo/editar
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id) VALUES ( 45, 5, 12,  7);--admin/cargo/deletar

--
-- Privileges
--

--
-- visitante
--
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  2, 1, true);--index/about
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  3, 1, true);--auth/login
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 11, 1, true);--auth/permissao-negada
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 12, 1, true);--zftool/module/list
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 13, 1, true);--zftool/create/module
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 14, 1, true);--zftool/create/controller


--
-- usuario
--
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  1, 2, true);--index/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  4, 2, true);--auth/logout
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  6, 2, true);--usuario/editar-senha


--
-- admin
--
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  7, 3, true);--usuario/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  8, 3, true);--usuario/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  5, 3, true);--usuario/editar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES (  9, 3, true);--usuario/deletar
--INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 10, 3, true);--auth/limpar-cache-acl
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 15, 3, true);--admin/index/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 16, 3, true);--admin/profissao/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 17, 3, true);--admin/profissao/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 18, 3, true);--admin/profissao/editar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 19, 3, true);--admin/profissao/deletar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 28, 3, true);--aluno/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 29, 3, true);--aluno/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 30, 3, true);--aluno/editar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 31, 3, true);--aluno/deletar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 37, 3, true);--admin/servidor/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 38, 3, true);--admin/servidor/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 39, 3, true);--admin/servidor/editar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 40, 3, true);--admin/servidor/deletar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 42, 3, true);--admin/cargo/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 43, 3, true);--admin/cargo/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 44, 3, true);--admin/cargo/editar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 45, 3, true);--admin/cargo/deletar

--
-- psicologo
--
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 20, 4, true);--psicologia/index/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 21, 4, true);--psicologia/acompanhamento/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 22, 4, true);--psicologia/acompanhamento/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 23, 4, true);--psicologia/acompanhamento/ajax-buscar-aluno
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 24, 4, true);--psicologia/acompanhamento/detalhes
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 25, 4, true);--psicologia/acompanhamento-individual/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 26, 4, true);--psicologia/acompanhamento-individual/editar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 27, 4, true);--psicologia/acompanhamento-individual/ajax-salvar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 28, 4, true);--aluno/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 29, 4, true);--aluno/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 30, 4, true);--aluno/editar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 31, 4, true);--aluno/deletar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 32, 4, true);--aluno/ajax-buscar-curso
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 33, 4, true);--psicologia/agendamento/index
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 34, 4, true);--psicologia/agendamento/criar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 35, 4, true);--psicologia/agendamento/editar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 36, 4, true);--psicologia/agendamento/deletar
INSERT INTO saa.acl_privileges(resource_id, role_id, allow) VALUES ( 41, 4, true);--psicologia/acompanhamento/agendamento/criar-acompanhamento-agendado
