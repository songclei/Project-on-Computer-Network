页面逻辑：

* 初始界面为index.php，跳转到activityList.html，显示活动列表

  * 活动列表列出网站上所有活动，每个活动可进入查看界面查看详细信息

    viewActivity.php -> viewActivityInfo.html

    * 若用户不是此活动的参加者，可在查看界面中申请加入此活动

      （申请应由活动管理员或者超级管理员审核，未实现）

* 注册/登陆 register/login.php -> register/login.html，结束后跳转到活动列表

* 创建活动 addActivity.php/html，创建结束后跳转到活动列表

* 活动管理 manageActivity.php/html
  * 活动管理界面只显示当前登陆用户所参加的活动
  * 若用户为活动的参加者，可以选择查看活动信息或者退出活动
  * 若用户为活动的管理员，还可以选择删除活动

* 若当前登陆用户为超级管理员，活动管理界面右上方有一个管理员入口 manageActivityManager.php/html
  * 管理员界面列出网站上所有活动，每个活动有管理选项 
  * 点击管理选项后进入有边栏的页面，默认进入第一个，infoManager.php/html
  * infoManager页面对活动信息作出修改（未实现）
  * 可通过边栏跳转到用户管理界面 attendentManager.php/html
    * 用户管理界面列出所有用户和他们的基本信息，每个用户有三种状态：未参加，参加者，管理员
      * 未参加者可以被添加为参加者或管理员
      * 参加者可以被添加为管理员或退出活动
      * 管理员可以被降为普通用户或退出活动
      
* 签到：当前活动开始时（begin_time）开放签到入口
 * 在user_activity表中，加一列signin表示是否签到成功，初始化为0表示未签到，1表示已签到
 * 在活动主页面上，首先检查该用户是否signin，如果signin在页面上（比如右上角）显示“签到成功！”，否则放一个二维码，二维码是网址 http://我们的IP/signin.php?activities_id=xxx 进行的编码。如果用户扫这个二维码，会跳转到这一个页面吧
 * 在signin.php中，根据SESSION可以获得user_id，根据GET可以获得activity_id，然后调用签到函数（user_activity.php中）
 * 在user_activity.php中，加一个函数表示签到，参数是据user_id和activity_id，可以找到这条记录并修改该记录的signin值为1
 * 最后header跳转到活动主页面，此时主页面右上角应该显示的是“签到成功！”
