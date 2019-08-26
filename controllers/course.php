<?php 
	
	/**
	 * 本类用来管理课程
	 */
	function abc($abc){
		return $abc;
	}
	class Course extends IController
	{
		protected $dataaa;
		public $layout = 'site';
		/**
		 * DateTime     ：  2019-08-12 12:36:55
		 * by           ：  junlong 
		 * email        ：  1421925814@qq.com
		 * decribe      ：  获取数据并且分页
		 */
		public function show ()
		{
			$page =  IReq::get('page');
			//默认为第一页
			$page = isset($page) ? $page : 1;

			$where = ' 1=1 ';
			$where .= isset($_POST['cid']) ? " and cate_id = " .$_POST['cid'] : "";
			$where .= isset($_POST['pid']) ? " and parent_id = " .$_POST['pid'] : "";
			$where .= isset($_POST['keyword']) ? " and a.name like '%" .$_POST['keyword'] . "%'" : "";
			// echo $where;
			//分类
			$cate = $this->category();
			$this->cate = $cate;

			

			
			
			//实例化课程表
			$course = new IQuery('imooc_course as a');
			$course->join = "join imooc_category as b on a.cate_id = b.id";
			//选取需要的字段
			$course->fields = "count(a.id) as count,cate_id,parent_id";

			$course->where = "$where";
			//查询总条数
			$count = $course->find();
			//总条数
			$count = $count[0]['count'];
			//每页显示条数
			$showPage = 10;
			//总页数
			$pageCount = ceil($count / $showPage);
			//两表关联查询分类名称
			$course->fields = "a.id as course_id ,a.name as course_name,b.name as cate_name,parent_id,is_vip";

			//分页每页6条
			$course->page = $page;
			$course->pagesize = $showPage;
			//查询数据
			$data = $course->find();
			//上一页
			$prev = $page - 1 < 1 ? 1 : $page - 1;
			// 下一页
			$next = $page + 1 > $pageCount ? $pageCount : $page + 1; 


			//判断是否ajax请求
			$val = isset($_POST['course']) ? $_POST['course'] : '';
			$is_ajax = $val == "course" ? true : false;
			if ($is_ajax) {
				$arr['prev'] = $prev;
				$arr['next'] = $next;
				$arr['pageCount'] = $pageCount;
				$arr['data'] = $data;
				$arr['page'] = $page;
				echo json_encode($arr);
			}else{
				$this->data = $data;
				$this->pageCount = $pageCount;
				$this->prev = $prev;
				$this->next = $next;
				$this->redirect('show');
				$this->page = $page;
			}

			
			
			// print_r($data);
			
		}
		/*
			分类
		 */
		public function category()
		{
			$val = isset($_POST['cate']) ? $_POST['cate'] : '';
			$is_ajax = $val == "cate" ? true : false;
			$cate = new IQuery('imooc_category');
			$data = $cate->find();
			$data = $this->getTree($data,0);
			if ($is_ajax) {
				echo json_encode($data);
			}else{
				return $data;
			}
		}
		/*
		递归方法
		param1 数据
		param2 父Id
		param3 等级
		 */
		public function getTree($data,$p_id,$lv=0)
		{
			static $arr = [];
			$lv++;
			foreach ($data as $key => $value) {
				if ($value['parent_id'] == $p_id) {
					$value['lv'] = $lv;
					$arr[] = $value;
					$this->getTree($data,$value['id'],$lv);
				}
			}
			return $arr;
		}
		

		/*
		是否购买
		 */
		public function is_buy()
		{
			$id = $_GET['id'];
			$course = new IQuery('imooc_course');
			$course->where = "id = $id";
			$data = $course->find();
			$data = $data[0];

			

			// print_r($data);die;
			if ($data['is_vip'] == 1) {
				$this->Showinfo($data['id']);
			}else{
				$list = new IQuery('imooc_list');
				$list->where = "parent_id = $data[id]";
				$data['list'] = $list->find();
				$this->list($data);
			}
			
		}

		public function buy($data)
		{
			echo 1;
		}


		public function list($data){
			$arr = array(
				1 => '初级',
				2 => '中级',
				3 => '高级',
			);
			$this->name = $data['name'];
			$this->desc = $data['desc'];
			$this->grade = $arr[$data['grade']];
			$this->list = $data['list'];
			$this->redirect('list',false);
		}

		public function video()
		{
			$id = $_GET['id'];
			$list = new IQuery('imooc_list');

			
			$list->where = "id = $id";
			$data = $list->find();
			$data = $data[0];
			// echo "<pre>";
			// print_r($data);
			$this->video = $data['path'];
			$this->redirect('video');
		}

		public function Showinfo($id)
		{

			// var_dump($course_id);

			$courseDB = new IQuery('imooc_course as a'); //goods是表名，这里不需要加前缀  
			$courseDB->join  = "join imooc_category as b on a.cate_id = b.id";
			$courseDB->where = "a.id = $id";
			$courseDB->fields="a.id,a.name as one,a.is_vip,a.desc,a.price,b.name";
			// print_r($courseDB);die;
			$courseDB = $courseDB->find(); //find方法就是执行查询，返回的是一个数组*/



			$data=$courseDB ;

			
			
			$this->data = $data;
	    	
			$this->redirect('showinfo',false);
		}
		public function Purchase()//展示订单
	{
		//判断是否登录;


		$course_id = IFilter::act(IReq::get("course_id"));

		

		$courseDB = new IQuery('imooc_course as a'); //goods是表名，这里不需要加前缀  
		$courseDB->join  = "join imooc_category as b on a.cate_id = b.id";
		$courseDB->where = "a.id = $course_id";
		$courseDB->fields="a.id,a.name,a.price";
		
		$courseDB = $courseDB->find(); //find方法就是执行查询，返回的是一个数组*/

		/*$goodsDB = new IModel('imooc_confirmation');//创建model对象,goods是表名
		$goodsDB->setData(array('price' => 1000));//设置表元素，是个二维数组
		$goodsDB->update('id = 2');    //执行更新动作，此时会把数组的数据更新到数据库中*/
		
		$this->data=$courseDB;
		
		
		
		$this->redirect('purchase',false);
	}

	public function Buycar()//加入购物操作
	{
		//判断是否登录;

		$user_id = 1;//模拟

		
		$course_id = IFilter::act(IReq::get("course_id"));
		$courseDB = new IQuery('imooc_course as a'); //goods是表名，这里不需要加前缀  
		$courseDB->join  = "join imooc_category as b on a.cate_id = b.id";
		$courseDB->where = "a.id = $course_id";
		$courseDB->fields="a.id,a.name,a.price,a.desc";
		
		$courseDB = $courseDB->find(); //find方法就是执行查询，返回的是一个数组*/

		$carDB = new IQuery('imooc_car as a');  
		$carDB->where = "a.course_id = $course_id";
		$carDB->fields="a.id";
		$carDB = $carDB->find(); 

		

		if ($carDB!=$arr) { //判断购物车是否含有此课程

			return $this -> carshow();
		}else{
			$name = $courseDB[0]['name'];
			$price = $courseDB['0']['price'];
			$desc = $courseDB['0']['desc'];
			$id = $courseDB['0']['id'];
			
			$carDB = new IModel('imooc_car');//创建model对象,goods是表名
			$carDB->setData(array('course_id'=>"$id",'course_name'=>"$name",'price'=>"$price",'desc'=>"$desc",'user_id'=>"$user_id"));//设置表元素，是个二维数组
			$carDB->add();    //执行更新动作，此时会把数组的数据更新到数据库中*/
			return $this -> carshow();

		}



	}

	public function carshow()//购物车展示
	{
		//判断是否登录;

		$user_id = 1;//模拟
		
		$carDB = new IQuery('imooc_car as a'); //goods是表名，这里不需要加前缀  
		$carDB->where = "a.user_id = $user_id";
		$carDB->fields="a.course_id,a.course_name,a.price,a.desc";
		
		$carDB = $carDB->find(); //find方法就是执行查询，返回的是一个数组*/

		$this->data = $carDB;
		
		$this->redirect('carshow');
	}

	public function Pay()//支付
	{
		//判断是否登录;

		$user_id = 1;//模拟

		$pay_id = IFilter::act(IReq::get("pay_id"));

		if ($pay_id=="1") {
			$payment = "微信";
		}
		if ($pay_id=="2") {
			$payment = "支付宝";
		}
		if ($pay_id=="3") {
			$payment = "银联";
		}

		$orderDB = new IModel('imooc_order');//创建model对象,goods是表名
		$orderDB->setData(array('payment'=>"$payment"));//设置表元素，是个二维数组
		$orderDB->add();    //执行更新动作，此时会把数组的数据更新到数据库中*/
		$this->show();
	}

	}
	
 ?>