<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/26
 * Time: 14:24
 */

namespace jerry;


class Ueditor
{
    protected  $config;

    /**
     * Ueditor constructor.
     * @param $config_array
     * 初始化配置参数
     */
    public function __construct($config_array=[])
    {
        $config = config::config();  //获取配置
        if(!empty($config_array)){
            foreach ($config_array as $k=>$v){
                $config[$k] = $v;
            }
        }
        $this->config = $config;
    }


    public function index($action)
    {
        switch ($action) {
            case 'config':
                $result =  json_encode($this->config);
                break;

            /* 上传图片 */
            case 'uploadimage':
                $result = $this->actUpload('uploadimage');
                break;

            /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':

            /* 列出图片 */
            case 'listimage':
    ;
            /* 列出文件 */
            case 'listfile':

            /* 抓取远程文件 */
            case 'catchimage':

            default:
        }

        /* 输出结果 */

        return $result;
    }

    public  function actUpload($action)
    {
        $base64 = "upload";
        switch (htmlspecialchars($action)) {
//            上传图片
            case 'uploadimage':
                $this->config = array(
                    "pathFormat" => $this->config['imagePathFormat'],
                    "maxSize" => $this->config['imageMaxSize'],
                    "allowFiles" => $this->config['imageAllowFiles']
                );
                $fieldName = $this->config['imageFieldName'];
                break;
            case 'uploadscrawl':
                $this->config = array(
                    "pathFormat" => $this->config['scrawlPathFormat'],
                    "maxSize" => $this->config['scrawlMaxSize'],
                    "allowFiles" => $this->config['scrawlAllowFiles'],
                    "oriName" => "scrawl.png"
                );
                $fieldName = $this->config['scrawlFieldName'];
                $base64 = "base64";
                break;
//                上传视频
            case 'uploadvideo':
                $this->config = array(
                    "pathFormat" => $this->config['videoPathFormat'],
                    "maxSize" => $this->config['videoMaxSize'],
                    "allowFiles" => $this->config['videoAllowFiles']
                );
                $fieldName = $this->config['videoFieldName'];
                break;
            case 'uploadfile':
            default:
                $this->config = array(
                    "pathFormat" => $this->config['filePathFormat'],
                    "maxSize" => $this->config['fileMaxSize'],
                    "allowFiles" => $this->config['fileAllowFiles']
                );
                $fieldName = $this->config['fileFieldName'];
                break;
        }

        /* 生成上传实例对象并完成上传 */
        $up = new Uploader($fieldName, $this->config, $base64);

        /**
         * 得到上传文件所对应的各个参数,数组结构
         * array(
         *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
         *     "url" => "",            //返回的地址
         *     "title" => "",          //新文件名
         *     "original" => "",       //原始文件名
         *     "type" => ""            //文件类型
         *     "size" => "",           //文件大小
         * )
         */

        /* 返回数据 */
        return $up->getFileInfo();
    }


}