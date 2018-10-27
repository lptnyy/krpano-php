<?php
	
/**************************************************************************
 *
 * 说明：素材图片操作类
 * 作者：李长明
 * 时间：20180917
 *
 *************************************************************************/

// 素材图片操作类
class BasicMaterialResourceUploader extends fileBaseOpHandler
{
	
	public function __construct($em)
	{
		parent::__construct($em);
	}
	
	//设置允许上传文件的类型
	protected  $type = array("jpg","gif","bmp","jpeg","png"); 
	

	//设置文件保存目录
	protected $uploadDir = '../../resource';
	
	public function parse($params)
	{
		$post = $params['post'];
		if (!$this->checkProps(['opCode'], $post)) {
			return false;
		}
		
			
		//根据操作
		$opCode = $post['opCode'];
		
		if (method_exists($this, $opCode)) {
			if (call_user_func_array(array($this, $opCode), array($params))) {
				return true;
			}
		}
		
		return true;
	}
	
	
	/**************************************************************************
	 *
	 * 说明：上传素材图片
	 * 作者：李长明
	 * 时间：20180920
	 */
	 
	protected function uploaderBasicMaterialImg($params)
	{
		
		$post = $params['post'];
		$files = $params['files'];
		
		$thumbPath = "";
		
		if (!$this->checkProps(['curEntityClass','layerid'], $post)) {
			return array();
		}
		
		$curEntityClass = $post['curEntityClass'];
		
		$layerid = $post['layerid'];
		
		$dir = $this->uploadDir . '/' . $curEntityClass . '/' .$layerid;
		
		$retUploader = array();
		
		$retUploader = $this->uploader($dir, $files, $this->type);
		
		$fileNamePath = $retUploader['filePath'];
		
		$targetFileName = $retUploader['fileName'];
		
		$result = $this->getResult();
		
		//上传失败
		if($result['state'] == "error") {
			
			return; 
		}
		
		//上传成功
		else {
			
			//$thumbPath = $this->createThumb($files,$dir);
			
		}
		
		//保存信息到数据库
		$conditions = array('id' => $layerid);
		
		$resourceEntity = $this->em->getRepository($curEntityClass)->findOneBy($conditions);

		if(!$resourceEntity) {
			
			return array();
		}
		
		
		//首先判断是否已经上传过 如果上传过则数据将不再插入库中
		$conditions = array('resFilePathInServer' => $fileNamePath);
		$resourcePano = $this->em->getRepository('PanoImgResource')->findOneBy($conditions);
		if($resourcePano) {
			
			$retArray = array(
		
				'id' => $resourcePano->getId(),
				'fileName' => $resourcePano->getResFileServerName(), 
				'filePath' => $resourcePano->getResFilePathInServer(), 
				'fileThumbPath' => $resourcePano->getResThumbFilePathInServer()
			);
			
			$this->setSuccessResult($retArray);
			return true;
		}
		
		
		$filename = $files['file']['name'];
		
		
		$dt = new DateTime('NOW');
		
		$t = $dt->format('Y-m-d H:i:s');
	
 		$basicMaterialResource = new BasicMaterialResource();
        $basicMaterialResource->setResType("图片");
        $basicMaterialResource->setResFilePathInServer($fileNamePath);
		$basicMaterialResource->setResThumbFilePathInServer($fileNamePath);
		$basicMaterialResource->setResUploadPerson("李长明");
		$basicMaterialResource->setResUploaderTime(new DateTime($t));
		$basicMaterialResource->setResFileServerName($filename);
		$basicMaterialResource->setBasicMaterialLayerInfo($resourceEntity);


		$this->em->persist($basicMaterialResource);

		$this->em->flush();
		
		$retArray = array(
		
					'id' => $basicMaterialResource->getId(),
					'fileName' => $filename, 
					'filePath' => $fileNamePath, 
					'fileThumbPath' => $fileNamePath
					);

		$this->setSuccessResult($retArray);
		
		return true;
	}
}