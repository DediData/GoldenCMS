<?php
/* Main Page (Multilingual[-Multiregional]) */
if (isset($fw['LANG'])) {
	$fw->route('GET @home_page: '.$fw['LANG'], 'core\controllers\Main->home_page');
}
$fw->route('GET @home_page_slash: '.$fw['LANG']. '/', 'core\controllers\Main->home_page');
$fw->route('GET @403: '.$fw['LANG']. '/403', 'core\controllers\Main->error_403');
$fw->route('GET @404: '.$fw['LANG']. '/404', 'core\controllers\Main->error_404');
$fw->route('GET @405: '.$fw['LANG']. '/405', 'core\controllers\Main->error_405');
$fw->route('GET @500: '.$fw['LANG']. '/500', 'core\controllers\Main->error_500');
$fw->route('GET @error: '.$fw['LANG']. '/error', 'core\controllers\Main->error');


/**
[routes]

; Index
GET / = controllers\Main->index

;GET /login = Controller\Index->login
;GET|POST /reset = Controller\Index->reset
;GET|POST /reset/forced = Controller\Index->reset_forced
;GET|POST /reset/@hash = Controller\Index->reset_complete
;POST /login = Controller\Index->loginpost
;POST /register = Controller\Index->registerpost
;GET|POST /logout = Controller\Index->logout
;GET|POST /ping = Controller\Index->ping

; Issues
;GET /issues = Controller\Issues->index
;GET /issues/new = Controller\Issues->add_selecttype
;GET /issues/new/@type = Controller\Issues->add
;GET /issues/new/@type/@parent = Controller\Issues->add
;GET /issues/edit/@id = Controller\Issues->edit
;POST /issues/save = Controller\Issues->save
;POST /issues/bulk_update = Controller\Issues->bulk_update
;GET /issues/export = Controller\Issues->export
;GET /issues/export/@id = Controller\Issues->export_single
;GET|POST /issues/@id = Controller\Issues->single
;GET|POST /issues/delete/@id = Controller\Issues->single_delete
;GET|POST /issues/undelete/@id = Controller\Issues->single_undelete
;POST /issues/comment/delete = Controller\Issues->comment_delete
;POST /issues/file/delete = Controller\Issues->file_delete
;POST /issues/file/undelete = Controller\Issues->file_undelete
;GET /issues/@id/history = Controller\Issues->single_history
;GET /issues/@id/related = Controller\Issues->single_related
;GET /issues/@id/watchers = Controller\Issues->single_watchers
;GET /issues/project/@id = Controller\Issues->project_overview
;GET /search = Controller\Issues->search
;POST /issues/upload = Controller\Issues->upload
;GET /issues/close/@id = Controller\Issues->close
;GET /issues/reopen/@id = Controller\Issues->reopen
;GET /issues/copy/@id = Controller\Issues->copy

; User pages
;GET /user = Controller\User->account
;POST /user = Controller\User->save
;POST /user/avatar = Controller\User->avatar
;GET /user/dashboard = Controller\User->dashboard
;GET /user/@username = Controller\User->single
;GET /user/@username/tree = Controller\User->single_tree

; Feeds
;GET /atom.xml = Controller\Index->atom

; Administration
;GET|POST /admin = Controller\Admin->index
;GET /admin/@tab = Controller\Admin->@tab

;GET /admin/users/new = Controller\Admin->user_new
;POST /admin/users/save = Controller\Admin->user_save
;GET /admin/users/@id = Controller\Admin->user_edit
;GET|POST /admin/users/@id/delete = Controller\Admin->user_delete

;POST /admin/groups/new = Controller\Admin->group_new
;GET|POST /admin/groups/@id = Controller\Admin->group_edit
;GET|POST /admin/groups/@id/delete = Controller\Admin->group_delete
;POST /admin/groups/ajax = Controller\Admin->group_ajax
;GET|POST /admin/groups/@id/setmanager/@user_group_id = Controller\Admin->group_setmanager

;GET|POST /admin/attributes/new = Controller\Admin->attribute_new
;GET|POST /admin/attributes/@id = Controller\Admin->attribute_edit
;GET|POST /admin/attributes/@id/delete = Controller\Admin->attribute_delete

;GET|POST /admin/sprints/new = Controller\Admin->sprint_new
;GET|POST /admin/sprints/@id = Controller\Admin->sprint_edit

;GET|POST /admin/plugins/@id = Controller\Admin->plugin_single

; Taskboard
;GET /taskboard/@id = Controller\Taskboard->index
;GET /taskboard/@id/@filter = Controller\Taskboard->index
;GET /taskboard/@id/burndown/@tasks = Controller\Taskboard->burndown
;POST /taskboard/add = Controller\Taskboard->add
;POST /taskboard/edit/@id = Controller\Taskboard->edit

; Backlog
;GET /backlog = Controller\Backlog->index
;GET /backlog/old = Controller\Backlog->index_old
;POST /backlog/edit = Controller\Backlog->edit
;GET /backlog/@filter = Controller\Backlog->index
;GET /backlog/@filter/@groupid = Controller\Backlog->index

; Files
;GET /files/thumb/@size-@id.@format = Controller\Files->thumb
;GET /files/preview/@id = Controller\Files->preview
;GET /files/@id/@name = Controller\Files->file
;GET /avatar/@size-@id.@format = Controller\Files->avatar

; Wiki
;GET /wiki = Controller\Wiki->index
;GET /wiki/@slug = Controller\Wiki->view
;GET|POST /wiki/edit = Controller\Wiki->edit
;GET /wiki/edit/@id = Controller\Wiki->edit

; REST API
;GET /issues.json = Controller\Api\Issues->get
;POST /issues.json = Controller\Api\Issues->post
;GET /issues/@id.json = Controller\Api\Issues->single_get
;PUT /issues/@id.json = Controller\Api\Issues->single_put
;DELETE /issues/@id.json = Controller\Api\Issues->single_delete
;GET /user/@username.json = Controller\Api\User->single_get
;GET /useremail/@email.json = Controller\Api\User->single_email
;GET /user.json = Controller\Api\User->get
;GET /usergroups.json = Controller\Api\User->get_group
*/