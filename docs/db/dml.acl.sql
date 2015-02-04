--
-- acl inserts
--

INSERT INTO acl_roles (id, role, parent) VALUES (1, 'visitante', NULL);
INSERT INTO acl_roles (id, role, parent) VALUES (2, 'usuario', 1);
INSERT INTO acl_roles (id, role, parent) VALUES (3, 'admin', 2);
INSERT INTO acl_roles (id, role, parent) VALUES (4, 'psicologo', 2);
INSERT INTO acl_roles (id, role, parent) VALUES (5, 'pedagogo', 2);


INSERT INTO acl_modules(id, module) VALUES (1, 'Application');
INSERT INTO acl_modules(id, module) VALUES (2, 'ZFTool');
INSERT INTO acl_modules(id, module) VALUES (3, 'Psicologia');
INSERT INTO acl_modules(id, module) VALUES (4, 'Pedagogia');
INSERT INTO acl_modules(id, module) VALUES (5, 'Admin');


INSERT INTO acl_controllers(id, controller) VALUES ( 1, 'Index');
INSERT INTO acl_controllers(id, controller) VALUES ( 2, 'Auth');
INSERT INTO acl_controllers(id, controller) VALUES ( 3, 'Usuario');
INSERT INTO acl_controllers(id, controller) VALUES ( 4, 'Module');
INSERT INTO acl_controllers(id, controller) VALUES ( 5, 'Create');


INSERT INTO acl_actions(id, action) VALUES (  1, 'index');
INSERT INTO acl_actions(id, action) VALUES (  2, 'about');
INSERT INTO acl_actions(id, action) VALUES (  3, 'login');
INSERT INTO acl_actions(id, action) VALUES (  4, 'logout');
INSERT INTO acl_actions(id, action) VALUES (  5, 'criar');
INSERT INTO acl_actions(id, action) VALUES (  6, 'editar');
INSERT INTO acl_actions(id, action) VALUES (  7, 'deletar');
INSERT INTO acl_actions(id, action) VALUES (  8, 'editar-senha');
--INSERT INTO acl_actions(id, action) VALUES (  9, 'limpar-cache-acl');
INSERT INTO acl_actions(id, action) VALUES ( 10, 'permissao-negada');
INSERT INTO acl_actions(id, action) VALUES ( 11, 'list');
INSERT INTO acl_actions(id, action) VALUES ( 12, 'module');
INSERT INTO acl_actions(id, action) VALUES ( 13, 'controller');


INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  1, 1,  1,  1);--index/index
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  2, 1,  1,  2);--index/about
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  3, 1,  2,  3);--auth/login
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  4, 1,  2,  4);--auth/logout
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  5, 1,  3,  6);--usuario/editar
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  6, 1,  3,  8);--usuario/editar-senha
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  7, 1,  3,  1);--usuario/index
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  8, 1,  3,  5);--usuario/criar
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES (  9, 1,  3,  7);--usuario/deletar
--INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES ( 10, 1,  2, 9);--auth/limpar-cache-acl
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES ( 11, 1,  2, 10);--auth/permissao-negada
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES ( 12, 2,  4, 11);--zftool/module/list
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES ( 13, 2,  5, 12);--zftool/create/module
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES ( 14, 2,  5, 13);--zftool/create/controller
INSERT INTO acl_resources(id, module_id, controller_id, action_id) VALUES ( 15, 5,  1,  1);--admin/index/index


--
-- visitante
--
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  2, 1, true);--index/about
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  3, 1, true);--auth/login
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES ( 11, 1, true);--auth/permissao-negada
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES ( 12, 1, true);--zftool/module/list
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES ( 13, 1, true);--zftool/create/module
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES ( 14, 1, true);--zftool/create/controller


--
-- usuario
--
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  1, 2, true);--index/index
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  4, 2, true);--auth/logout
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  6, 2, true);--usuario/editar-senha


--
-- admin
--
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  7, 3, true);--usuario/index
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  8, 3, true);--usuario/criar
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  5, 3, true);--usuario/editar
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES (  9, 3, true);--usuario/deletar
--INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES ( 10, 3, true);--auth/limpar-cache-acl
INSERT INTO acl_privileges(resource_id, role_id, allow) VALUES ( 15, 3, true);--admin/index/index
