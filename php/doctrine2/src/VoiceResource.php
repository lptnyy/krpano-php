<?php
	/**
 	 * create By :lichangming
	 * time : 20180915
     * src/VoiceResource.php
     */
	use Doctrine\Common\Collections\ArrayCollection;
		
	/**
	 * @Entity(repositoryClass="")
	 * @Table(name="VoiceResource")
	 */
	class VoiceResource
	{
		/**
		 * @Id @Column(type="integer") @GeneratedValue
		 * @var int
		 */
		protected $id;
		
		/**
		 * 资源类型
		 * @Column(type="string",options={"comment":"资源类型"})
		 * @var string
		 */
		protected $resType;

		/**
		 * 资源路径
		 * @Column(type="string",options={"comment":"资源路径"})
		 * @var string
		 */
		protected $resFilePathInServer;
		
		/**
		 * 缩率图资源路径
		 * @Column(type="string",options={"comment":"缩率图资源路径"})
		 * @var string
		 */
		protected $resThumbFilePathInServer;
		
		/**
		 * 上传人
		 * @Column(type="string",options={"comment":"上传人"})
		 * @var string
		 */
		protected $resUploadPerson;


		/**
		 * 上传时间
		 * @Column(type="datetime",options={"comment":"上传时间"})
		 * @var datetime
		 */
		protected $resUploaderTime;
		
        /**
         * 上传文件名
         * @Column(type="string",options={"comment":"上传文件名"})
         * @var string
         */
        protected $resFileServerName;


		/**
		 * @ManyToOne(targetEntity="VoiceLayer", inversedBy="voiceLayerList",cascade={"persist","refresh"})
		 * @JoinColumn(name="layerId",referencedColumnName="id" )
		 */
		protected  $voiceLayerInfo;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set resType
     *
     * @param string $resType
     *
     * @return VoiceResource
     */
    public function setResType($resType)
    {
        $this->resType = $resType;

        return $this;
    }

    /**
     * Get resType
     *
     * @return string
     */
    public function getResType()
    {
        return $this->resType;
    }

    /**
     * Set resFilePathInServer
     *
     * @param string $resFilePathInServer
     *
     * @return VoiceResource
     */
    public function setResFilePathInServer($resFilePathInServer)
    {
        $this->resFilePathInServer = $resFilePathInServer;

        return $this;
    }

    /**
     * Get resFilePathInServer
     *
     * @return string
     */
    public function getResFilePathInServer()
    {
        return $this->resFilePathInServer;
    }

    /**
     * Set resThumbFilePathInServer
     *
     * @param string $resThumbFilePathInServer
     *
     * @return VoiceResource
     */
    public function setResThumbFilePathInServer($resThumbFilePathInServer)
    {
        $this->resThumbFilePathInServer = $resThumbFilePathInServer;

        return $this;
    }

    /**
     * Get resThumbFilePathInServer
     *
     * @return string
     */
    public function getResThumbFilePathInServer()
    {
        return $this->resThumbFilePathInServer;
    }

    /**
     * Set resUploadPerson
     *
     * @param string $resUploadPerson
     *
     * @return VoiceResource
     */
    public function setResUploadPerson($resUploadPerson)
    {
        $this->resUploadPerson = $resUploadPerson;

        return $this;
    }

    /**
     * Get resUploadPerson
     *
     * @return string
     */
    public function getResUploadPerson()
    {
        return $this->resUploadPerson;
    }

    /**
     * Set resUploaderTime
     *
     * @param \DateTime $resUploaderTime
     *
     * @return VoiceResource
     */
    public function setResUploaderTime($resUploaderTime)
    {
        $this->resUploaderTime = $resUploaderTime;

        return $this;
    }

    /**
     * Get resUploaderTime
     *
     * @return \DateTime
     */
    public function getResUploaderTime()
    {
        return $this->resUploaderTime;
    }

    /**
     * Set resFileServerName
     *
     * @param string $resFileServerName
     *
     * @return VoiceResource
     */
    public function setResFileServerName($resFileServerName)
    {
        $this->resFileServerName = $resFileServerName;

        return $this;
    }

    /**
     * Get resFileServerName
     *
     * @return string
     */
    public function getResFileServerName()
    {
        return $this->resFileServerName;
    }

    /**
     * Set voiceLayerInfo
     *
     * @param \VoiceLayer $voiceLayerInfo
     *
     * @return VoiceResource
     */
    public function setVoiceLayerInfo(\VoiceLayer $voiceLayerInfo = null)
    {
        $this->voiceLayerInfo = $voiceLayerInfo;

        return $this;
    }

    /**
     * Get voiceLayerInfo
     *
     * @return \VoiceLayer
     */
    public function getVoiceLayerInfo()
    {
        return $this->voiceLayerInfo;
    }
}
