#1. 
cpmposer require Illuminate\Html
app.config 的provider里添加‘ Illuminate\Html\HtmlServiceProvider::class,’
app.config的aliases里添加’
'Form'      => Illuminate\Html\FormFacade::class,
#2.
在public/css下添加boot的六个css文件和font的2的css文件
#3.
修改discussion.php中$fillable=['title','body','user_id','last_user_id'];
   user.php中$fillable=['name', 'email', 'password','avatar'];
#4.
生成测试数据:在database/modelfacory下
#5.
修改model层文件,User下添加getDis(),Discussion下添加getDis()