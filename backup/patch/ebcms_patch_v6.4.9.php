<?php 
function ebcms_upgrade(){
	// 新增消息数据库
	$sqls = <<<'str'
ALTER TABLE `ebcms5_guestbook` ADD COLUMN `ip` VARCHAR(255) NULL DEFAULT '' AFTER `locked`;
str;

	$sqls = explode(";\r\n", $sqls);
	foreach ($sqls as $key => $sql) {
		$sql = str_replace('ebcms5_', config('database.prefix'), $sql);
		\think\Db::execute($sql);
	}
	return true;
}