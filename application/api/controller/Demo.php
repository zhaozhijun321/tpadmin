<?php

namespace app\api\controller;

use app\common\controller\Api;
use EasyWeChat\Foundation\Application;

/**
 * 示例接口
 */
class Demo extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['test', 'test1','sync_wechat'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test2'];

    /**
     * 测试方法
     *
     * @ApiTitle    (测试名称)
     * @ApiSummary  (测试描述信息)
     * @ApiMethod   (POST)
     * @ApiRoute    (/api/demo/test/id/{id}/name/{name})
     * @ApiHeaders  (name=token, type=string, required=true, description="请求的Token")
     * @ApiParams   (name="id", type="integer", required=true, description="会员ID")
     * @ApiParams   (name="name", type="string", required=true, description="用户名")
     * @ApiParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据")
     * @ApiReturnParams   (name="code", type="integer", required=true, sample="0")
     * @ApiReturnParams   (name="msg", type="string", required=true, sample="返回成功")
     * @ApiReturnParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据返回")
     * @ApiReturn   ({
         'code':'1',
         'msg':'返回成功'
        })
     */
    public function test()
    {
        $this->success('返回成功', $this->request->param());
    }

    /**
     * 无需登录的接口
     *
     */
    public function test1()
    {
        $this->success('返回成功', ['action' => 'test1']);
    }

    /**
     * 需要登录的接口
     *
     */
    public function test2()
    {
        $this->success('返回成功', ['action' => 'test2']);
    }

    /**
     * 需要登录且需要验证有相应组的权限
     *
     */
    public function test3()
    {
        $this->success('返回成功', ['action' => 'test3']);
    }

     //同步微信公众平台


    public function sync_wechat(){
        ignore_user_abort(true); // 忽略客户端断开 

        set_time_limit(0);    // 设置执行不超时
        //检测参数
        if(!$_POST['title']){
            file_put_contents('a.txt','title参数丢失！');
                exit();
        }
        if(!$_POST['image']){
            file_put_contents('a.txt','image参数丢失！');

                exit();
        }

         $wecatData = $_POST;
        

        try {
                $app = new Application(get_addon_config('wechat'));
                // //获取封面素材media_id
                 $res = $app->material->uploadImage(dirpath($wecatData['image']));
                 $urlArr = json_decode($res);
                 $wecatData['thumb_media_id'] = $urlArr->media_id;
                 // 'JfrrO1DEuvV1zv3GA_pDfBGyuTgme63ZWpcHAK27vc4';
                 // file_put_contents('b.txt', $urlArr->media_id);
                 unset($wecatData['image']);
                //正则匹配文章所有图片
                $articleImage =getImgs($wecatData['content']);

                if(!empty($articleImage)){
                    $newimg =[];
                    try {
                        // //循环获取微信上传路径
                            foreach ($articleImage   as $key => $value) {
                              $newimg[] =json_decode($app->material->uploadArticleImage(dirpath($value)))->url; 

                            }

                        
                        //循环替换成微信的路径
                         $articlestr=$wecatData['content'];
                          foreach ($articleImage   as $key => $value) {
                               $articlestr= str_replace($value,$newimg[$key],$articlestr); 
                          }
                         //假如执行成功
                          $wecatData['content'] = $articlestr;
                          $wecatData['digest']='';
                          // var_dump($wecatData);
                          // exit;
                           try {
                             $res =  $app->material->uploadArticle($wecatData);
                            file_put_contents('a.txt', $res);
                            exit;
                               
                           } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                               $this->error($e->getMessage());
                           }

                        }catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                            $this->error($e->getMessage());
                    }
                }

                } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                    $this->error($e->getMessage());
            }
            
    }
  	
  	//获取新闻接口
  	public function news()
    {
    	    $appkey = 'd1518b1f7d0d467967269ca2b283f435';//你的appkey
            $channel= isset($_POST['news']) ? $_POST['news'] : 'top';//类型,,top(头条，默认),shehui(社会),guonei(国内),guoji(国际),yule(娱乐),tiyu(体育)junshi(军事),keji(科技),caijing(财经),shishang(时尚)
        $url = "http://v.juhe.cn/toutiao/index?type=$channel&key=$appkey";
            $json = file_get_contents($url);
            $jsonarr = json_decode($json, true);

             if ($jsonarr['reason'] == '超过每日可允许请求次数!') {
                echo '<center><h1>超过每日可允许请求次数！</h1></center>';
                die;
             }
            echo '<table border="1" width="600" align="center">';
            echo '<th>发布日期</th><th>文章封面</th><th>标题</th><th>文章类型</th><th>文章来源</th><th>文章链接</th>';

            foreach($jsonarr['result']['data'] as $key => $value) {
                echo '<tr>';
                    echo '<td>'.$value['date'].'</td>';
                    echo '<td><img width="140" height="120" src="'.$value['thumbnail_pic_s'].'" /></td>';
                    echo '<td>'.$value['title'].'</td>';
                    echo '<td>'.$value['category'].'</td>';
                    echo '<td>'.$value['author_name'].'</td>';
                    echo '<td><a href="'.$value['url'].'"  target="view_window">文章详情</a></td>';
                echo '</tr>';

            }

            echo '</table>';

  
    
    }


}
