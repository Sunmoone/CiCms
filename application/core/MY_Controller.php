<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 前台父控制器
 *
 */
class Front_Controller extends CI_Controller {
    protected $data = array();

    public function __construct()
    {
        parent::__construct();

        header("Content-type: text/html; charset=utf-8");

        $this->load->library('layout');
        $this->layout->setLayout('front_main');
        $this->load->model('model_content', 'content', TRUE);
        $this->load->model('model_category', 'category', TRUE);
        $this->load->library('tree');
        $categorys = $this->category->get_categorys();
        if ($categorys) {
          $this->tree->setTree($categorys['data']);
          $this->data['category'] = $this->tree->buildTree();
        } else {
          $this->data['category'] = array();
        }
        
    }
}

/**
 * 后台父控制器
 *
 */
class Admin_Controller extends CI_Controller {
    public $admin_user = array();

    public function __construct()
    {
        parent::__construct();

        header("Content-type: text/html; charset=utf-8");

        if (!$this->session->userdata('admin_user'))
        {
            redirect('admin/login', 'refresh');
        }

        $this->load->library('layout');

        if (isset($_GET['menu_index'])) 
        {
            $this->session->set_userdata('menu_index', $_GET['menu_index']);
        }
        if (isset($_GET['menu_current'])) 
        {
            $this->session->set_userdata('menu_current', $_GET['menu_current']);
        }

        $this->admin_user = $this->session->userdata('admin_user');
        $permission = $this->admin_user['permission'];
        $menus = array(
            '系统' => array(
                '用户管理' => 'admin/user',
                '角色管理' => 'admin/role',
                '节点管理' => 'admin/node',
            ),
            '内容' => array(
            	  '分类管理' => 'admin/category',
                '内容管理' => 'admin/content',
            ),
        );

        $menu = array();
        foreach($menus as $k => $v) {
            foreach($v as $key => $val) {
                if(in_array($val, $permission)) {
                  $menu[$k][$key] = $val;
                }
            }
        }
        $this->menu = $menu;

        // 检查权限
        $uri = uri_string();
        $uri = explode('/', $uri);
        $uri = array_slice($uri, 0, 3);
        $uri = implode('/', $uri);

        if (!in_array($uri, $permission))
        {
            show_error("没有权限!");
        }
    }

  function file_upload()
  {
      /* 上传类配置 */
      $config['upload_path'] = './assets/upload/'; /* NB! create this dir! */
      $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
      $config['max_size']  = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      /* 加载上传类 */
      $this->load->library('upload', $config);

      /* 图片处理类配置 */
      $configThumb = array();
      $configThumb['image_library'] = 'gd2';
      $configThumb['source_image'] = '';
      $configThumb['create_thumb'] = TRUE;
      $configThumb['maintain_ratio'] = TRUE;
      /* 设置缩略图的宽和高 */
      /* 缩略图会被保存在相同的目录 但会以 _thumb 为后缀 */
      /* 例如 'image.jpg' 缩略图会被保存为 'image_thumb.jpg' */
      $configThumb['width'] = 320;
      $configThumb['height'] = 160;
      /* 加载图片处理类 */
      $this->load->library('image_lib');

      /* 处理文件上传 */
      $upload = $this->upload->do_upload('image');
      if($upload === FALSE){
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('error', $error);
          go_back();
      }
      /* 获取文件数据 */
      $data = $this->upload->data();
      $file_name = $data['file_name'];
      /* 如果是图片创建缩略图 */
      if($data['is_image'] == 1) {
          $configThumb['source_image'] = $data['full_path'];
          $this->image_lib->initialize($configThumb);
          $this->image_lib->resize();
      }
      return $file_name;
  }

}

class ServerInfo
{//类定义开始

     /**
      *----------------------------------------------------------
      * 获取服务器时间
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetServerTime()
     {
         return date('Y-m-d　H:i:s');
     }

     /**
      *----------------------------------------------------------
      * 获取服务器解译引擎
      * 例如：Apache/2.2.8 (Win32) PHP/5.2.6
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetServerSoftwares()
     {
         return $_SERVER['SERVER_SOFTWARE'];
     }

     /**
      *----------------------------------------------------------
      * 获取php版本号
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetPhpVersion()
     {
         return PHP_VERSION;
     }

     /**
      *----------------------------------------------------------
      * 获取Mysql版本号
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetMysqlVersion()
     {
         return mysql_get_server_info();
     }

     /**
      *----------------------------------------------------------
      * 获取Http版本号
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetHttpVersion()
     {
         return $_SERVER['SERVER_PROTOCOL'];
     }

     /**
      *----------------------------------------------------------
      * 获取网站根目录
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetDocumentRoot()
     {
         return $_SERVER['DOCUMENT_ROOT'];
     }

     /**
      *----------------------------------------------------------
      * 获取PHP脚本最大执行时间
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetMaxExecutionTime()
     {
         return ini_get('max_execution_time').' Seconds';
     }

     /**
      *----------------------------------------------------------
      * 获取服务器允许文件上传的大小
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetServerFileUpload()
     {
         if (@ini_get('file_uploads')) {
             return '允许 '.ini_get('upload_max_filesize');
         } else {
             return '<font color="red">禁止</font>';
         }
     }

     /**
      *----------------------------------------------------------
      * 获取全局变量 register_globals的设置信息 On/Off
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetRegisterGlobals()
     {
         return self::GetPhpCfg('register_globals');
     }

     /**
      *----------------------------------------------------------
      * 获取安全模式 safe_mode的设置信息 On/Off
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetSafeMode()
     {
         return self::GetPhpCfg('safe_mode');
     }

     /**
      *----------------------------------------------------------
      * 获取Gd库的版本号
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetGdVersion()
     {
         if(function_exists('gd_info')){
             $GDArray = gd_info();
             $gd_version_number = $GDArray['GD Version'] ? '版本：'.$GDArray['GD Version'] : '不支持';
         }else{
             $gd_version_number = '不支持';
         }
         return $gd_version_number;
     }

     /**
      *----------------------------------------------------------
      * 获取内存占用率
      *----------------------------------------------------------
      * @access public
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     public static function GetMemoryUsage()
     {
         return self::ConversionDataUnit(memory_get_usage());
     }

     /**
      *----------------------------------------------------------
      * 对数据单位 (字节)进行换算
      *----------------------------------------------------------
      * @access private
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     private static function ConversionDataUnit($size)
     {
         $kb = 1024;       // Kilobyte
         $mb = 1024 * $kb; // Megabyte
         $gb = 1024 * $mb; // Gigabyte
         $tb = 1024 * $gb; // Terabyte
         //round() 对浮点数进行四舍五入
         if($size < $kb) {
             return $size.' Byte';
         }
         else if($size < $mb) {
             return round($size/$kb,2).' KB';
         }
         else if($size < $gb) {
             return round($size/$mb,2).' MB';
         }
         else if($size < $tb) {
             return round($size/$gb,2).' GB';
         }
         else {
             return round($size/$tb,2).' TB';
         }
     }

     /**
      *----------------------------------------------------------
      * 获取PHP配置文件 (php.ini)的值
      *----------------------------------------------------------
      * @param string $val 值
      * @access private
      *----------------------------------------------------------
      * @return string
      *----------------------------------------------------------
      */
     private static function GetPhpCfg($val)
     {
         switch($result = get_cfg_var($val)) {
         case 0:
             return '关闭';
             break;
         case 1:
             return '打开';
             break;
         default:
             return $result;
             break;
         }
     }

}//类定义结束

