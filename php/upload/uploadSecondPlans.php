<?php


	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	include "uploadManager.php";


	//系统参数校验
	$ret = uploaderSecondPlansManager::instance()->sysParamCheck();
	if(!$ret) {
		exit;
	}

	//自定义参数校验
	$ret = uploaderSecondPlansManager::instance()->customParamCheck();
	if(!$ret) {
		exit;
	}

	//根据地区+目标类型+具体目标+资源分类+资源类型 创建文件夹
	uploaderSecondPlansManager::instance()->createFileDirByTargetProperty();

	//是否清除之前的临时文件
	if(uploaderSecondPlansManager::instance()->getCleanUpFlag()) {
		uploaderSecondPlansManager::instance()->cleanTempFiles();
	}

	//写文件操作
	$ret = uploaderSecondPlansManager::instance()->optionUploaderFileWirteAndRead();



?>