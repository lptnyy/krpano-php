<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	include "uploadManager.php";
	//ϵͳ����У��
	$ret = uploaderChatMessagesManager::instance()->sysParamCheck();
	if(!$ret) {
		exit;
	}

	//�Զ������У��
	$ret = uploaderChatMessagesManager::instance()->customParamCheck();
	if(!$ret) 
	{
		exit;
	}

	//���ݵ���+Ŀ������+����Ŀ��+��Դ����+��Դ���� �����ļ���
	uploaderChatMessagesManager::instance()->createFileDirByTargetProperty();

	//�Ƿ����֮ǰ����ʱ�ļ�
	if(uploaderChatMessagesManager::instance()->getCleanUpFlag()) {
		uploaderChatMessagesManager::instance()->cleanTempFiles();
	}

	//д�ļ�����
	$ret = uploaderChatMessagesManager::instance()->optionUploaderFileWirteAndRead();



?>