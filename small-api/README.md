# small-api

> 服务端接口 采用 ThinkPHP5.1 开发

生成类库映射文件 php think optimize:autoload

生成配置缓存 php think optimize:config

生成数据表字段缓存 php think optimize:schema 

生成路由映射缓存 php think optimize:route


模型：
新增数据的最佳实践原则：使用create方法新增数据，使用saveAll批量新增数据。

更新的最佳实践原则是：如果需要使用模型事件，那么就先查询后更新，如果不需要使用事件，直接使用静态的Update方法进行条件更新，如非必要，尽量不要使用批量更新。

模型查询的最佳实践原则是：在模型外部使用静态方法进行查询，内部使用动态方法查询，包括使用数据库的查询构造器。模型的查询始终返回对象实例，但可以和数组一样使用。

删除的最佳实践原则是：如果删除当前模型数据，用delete方法，如果需要直接删除数据，使用destroy静态方法。