<p align="center">
<img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 关于 FantasyCode

FantasyCode 是我基于Laravel6.0框架和semantic-ui开发的一个个人博客社区网站。其实前端页面样式风格参考【learnku.net】 https://www.learnku.net，表示感谢!
- 用户认证 —— 注册、登录、退出；
- 个人中心 —— 用户个人中心，编辑资料
- 上传图片 —— 修改头像时候上传图片
- 文章的 列表 发布 修改 删除 评论以及评论
- 文章支持MarkDown语法，参考 learnku.net代码
- 文章评论 邮件提醒

## 安装

1. 克隆 FantasyCode 源代码到本地：

```
  git clone  https://gitee.com/uknowfantasy/FantasyCode.git
```

2. 创建 .env文件 key 以及安装扩展包
```$xslt
   cp .env.example .env
   php artisan key:generate
   composer isntall
```
3.生成数据表及生成测试数据(seed文件下存在注释)
```$xslt
 php artisan migrate --seed

```

4.生成密钥

```$xslt
php artisan key:generate

php artisan jwt:secret
```

5.安装前端资源
```$xslt
  npm install 或者  yarn install
  
  npm run watch-poll

```

