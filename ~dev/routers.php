<?php
// paper of routes
$app->router->get('/paper', [PaperController::class, 'paperIndex']);
$app->router->get('/paper/build', [PaperController::class, 'paperBuild']);
$app->router->post('/paper/build', [PaperController::class, 'paperRecord']);
$app->router->get('/paper/{paperIdentify}/destroy', [PaperController::class, 'paperDestroy']);
$app->router->get('/paper/{paperIdentify}/modify', [PaperController::class, 'paperModify']);
$app->router->post('/paper/{paperIdentify}/modify', [PaperController::class, 'paperEdit']);
$app->router->get('/paper/{paperIdentify}', [PaperController::class, 'paperDisplay']);

// lamination of routes
$app->router->get('/lamination', [LaminationController::class, 'laminationIndex']);
$app->router->get('/lamination/build', [LaminationController::class, 'laminationBuild']);
$app->router->post('/lamination/build', [LaminationController::class, 'laminationRecord']);
$app->router->get('/lamination/{laminationIdentify}/destroy', [LaminationController::class, 'laminationDestroy']);
$app->router->get('/lamination/{laminationIdentify}/modify', [LaminationController::class, 'laminationModify']);
$app->router->post('/lamination/{laminationIdentify}/modify', [LaminationController::class, 'laminationEdit']);
$app->router->get('/lamination/{laminationIdentify}', [LaminationController::class, 'laminationDisplay']);

// paper of routes
$app->router->get('/paper', [PaperController::class, 'paperIndex']);
$app->router->get('/paper/build', [PaperController::class, 'paperBuild']);
$app->router->post('/paper/build', [PaperController::class, 'paperRecord']);
$app->router->get('/paper/{paperIdentify}/destroy', [PaperController::class, 'paperDestroy']);
$app->router->get('/paper/{paperIdentify}/modify', [PaperController::class, 'paperModify']);
$app->router->post('/paper/{paperIdentify}/modify', [PaperController::class, 'paperEdit']);
$app->router->get('/paper/{paperIdentify}', [PaperController::class, 'paperDisplay']);

// paper of routes
$app->router->get('/paper', [PaperController::class, 'paperIndex']);
$app->router->get('/paper/build', [PaperController::class, 'paperBuild']);
$app->router->post('/paper/build', [PaperController::class, 'paperRecord']);
$app->router->get('/paper/{paperIdentify}/destroy', [PaperController::class, 'paperDestroy']);
$app->router->get('/paper/{paperIdentify}/modify', [PaperController::class, 'paperModify']);
$app->router->post('/paper/{paperIdentify}/modify', [PaperController::class, 'paperEdit']);
$app->router->get('/paper/{paperIdentify}', [PaperController::class, 'paperDisplay']);

// paper of routes
$app->router->get('/paper', [PaperController::class, 'paperIndex']);
$app->router->get('/paper/build', [PaperController::class, 'paperBuild']);
$app->router->post('/paper/build', [PaperController::class, 'paperRecord']);
$app->router->get('/paper/{paperIdentify}/destroy', [PaperController::class, 'paperDestroy']);
$app->router->get('/paper/{paperIdentify}/modify', [PaperController::class, 'paperModify']);
$app->router->post('/paper/{paperIdentify}/modify', [PaperController::class, 'paperEdit']);
$app->router->get('/paper/{paperIdentify}', [PaperController::class, 'paperDisplay']);

// factory of routes
$app->router->get('/factory', [FactoryController::class, 'factoryIndex']);
$app->router->get('/factory/build', [FactoryController::class, 'factoryBuild']);
$app->router->post('/factory/build', [FactoryController::class, 'factoryRecord']);
$app->router->get('/factory/{factoryIdentify}/destroy', [FactoryController::class, 'factoryDestroy']);
$app->router->get('/factory/{factoryIdentify}/modify', [FactoryController::class, 'factoryModify']);
$app->router->post('/factory/{factoryIdentify}/modify', [FactoryController::class, 'factoryEdit']);
$app->router->get('/factory/{factoryIdentify}', [FactoryController::class, 'factoryDisplay']);

// templete of routes
$app->router->get('/templete', [TempleteController::class, 'templeteIndex']);
$app->router->get('/templete/build', [TempleteController::class, 'templeteBuild']);
$app->router->post('/templete/build', [TempleteController::class, 'templeteRecord']);
$app->router->get('/templete/{templeteIdentify}/destroy', [TempleteController::class, 'templeteDestroy']);
$app->router->get('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteModify']);
$app->router->post('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteEdit']);
$app->router->get('/templete/{templeteIdentify}', [TempleteController::class, 'templeteDisplay']);

// templete of routes
$app->router->get('/templete', [TempleteController::class, 'templeteIndex']);
$app->router->get('/templete/build', [TempleteController::class, 'templeteBuild']);
$app->router->post('/templete/build', [TempleteController::class, 'templeteRecord']);
$app->router->get('/templete/{templeteIdentify}/destroy', [TempleteController::class, 'templeteDestroy']);
$app->router->get('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteModify']);
$app->router->post('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteEdit']);
$app->router->get('/templete/{templeteIdentify}', [TempleteController::class, 'templeteDisplay']);

// templete of routes
$app->router->get('/templete', [TempleteController::class, 'templeteIndex']);
$app->router->get('/templete/build', [TempleteController::class, 'templeteBuild']);
$app->router->post('/templete/build', [TempleteController::class, 'templeteRecord']);
$app->router->get('/templete/{templeteIdentify}/destroy', [TempleteController::class, 'templeteDestroy']);
$app->router->get('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteModify']);
$app->router->post('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteEdit']);
$app->router->get('/templete/{templeteIdentify}', [TempleteController::class, 'templeteDisplay']);

// templete of routes
$app->router->get('/templete', [TempleteController::class, 'templeteIndex']);
$app->router->get('/templete/build', [TempleteController::class, 'templeteBuild']);
$app->router->post('/templete/build', [TempleteController::class, 'templeteRecord']);
$app->router->get('/templete/{templeteIdentify}/destroy', [TempleteController::class, 'templeteDestroy']);
$app->router->get('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteModify']);
$app->router->post('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteEdit']);
$app->router->get('/templete/{templeteIdentify}', [TempleteController::class, 'templeteDisplay']);

// templete of routes
$app->router->get('/templete', [TempleteController::class, 'templeteIndex']);
$app->router->get('/templete/build', [TempleteController::class, 'templeteBuild']);
$app->router->post('/templete/build', [TempleteController::class, 'templeteRecord']);
$app->router->get('/templete/{templeteIdentify}/destroy', [TempleteController::class, 'templeteDestroy']);
$app->router->get('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteModify']);
$app->router->post('/templete/{templeteIdentify}/modify', [TempleteController::class, 'templeteEdit']);
$app->router->get('/templete/{templeteIdentify}', [TempleteController::class, 'templeteDisplay']);

// Paper of routes
$app->router->get('/Paper', [PaperController::class, 'PaperIndex']);
$app->router->get('/Paper/build', [PaperController::class, 'PaperBuild']);
$app->router->post('/Paper/build', [PaperController::class, 'PaperRecord']);
$app->router->get('/Paper/{PaperIdentify}/destroy', [PaperController::class, 'PaperDestroy']);
$app->router->get('/Paper/{PaperIdentify}/modify', [PaperController::class, 'PaperModify']);
$app->router->post('/Paper/{PaperIdentify}/modify', [PaperController::class, 'PaperEdit']);
$app->router->get('/Paper/{PaperIdentify}', [PaperController::class, 'PaperDisplay']);

// paper of routes
$app->router->get('/paper', [PaperController::class, 'paperIndex']);
$app->router->get('/paper/build', [PaperController::class, 'paperBuild']);
$app->router->post('/paper/build', [PaperController::class, 'paperRecord']);
$app->router->get('/paper/{paperIdentify}/destroy', [PaperController::class, 'paperDestroy']);
$app->router->get('/paper/{paperIdentify}/modify', [PaperController::class, 'paperModify']);
$app->router->post('/paper/{paperIdentify}/modify', [PaperController::class, 'paperEdit']);
$app->router->get('/paper/{paperIdentify}', [PaperController::class, 'paperDisplay']);

// paper of routes
$app->router->get('/paper', [PaperController::class, 'paperIndex']);
$app->router->get('/paper/build', [PaperController::class, 'paperBuild']);
$app->router->post('/paper/build', [PaperController::class, 'paperRecord']);
$app->router->get('/paper/{paperIdentify}/destroy', [PaperController::class, 'paperDestroy']);
$app->router->get('/paper/{paperIdentify}/modify', [PaperController::class, 'paperModify']);
$app->router->post('/paper/{paperIdentify}/modify', [PaperController::class, 'paperEdit']);
$app->router->get('/paper/{paperIdentify}', [PaperController::class, 'paperDisplay']);

// heroVideos of routes
$app->router->get('/heroVideos', [HeroVideosController::class, 'heroVideosIndex']);
$app->router->get('/heroVideos/build', [HeroVideosController::class, 'heroVideosBuild']);
$app->router->post('/heroVideos/build', [HeroVideosController::class, 'heroVideosRecord']);
$app->router->get('/heroVideos/{heroVideosIdentify}/destroy', [HeroVideosController::class, 'heroVideosDestroy']);
$app->router->get('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosModify']);
$app->router->post('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosEdit']);
$app->router->get('/heroVideos/{heroVideosIdentify}', [HeroVideosController::class, 'heroVideosDisplay']);

// heroVideos of routes
$app->router->get('/heroVideos', [HeroVideosController::class, 'heroVideosIndex']);
$app->router->get('/heroVideos/build', [HeroVideosController::class, 'heroVideosBuild']);
$app->router->post('/heroVideos/build', [HeroVideosController::class, 'heroVideosRecord']);
$app->router->get('/heroVideos/{heroVideosIdentify}/destroy', [HeroVideosController::class, 'heroVideosDestroy']);
$app->router->get('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosModify']);
$app->router->post('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosEdit']);
$app->router->get('/heroVideos/{heroVideosIdentify}', [HeroVideosController::class, 'heroVideosDisplay']);

// heroVideos of routes
$app->router->get('/heroVideos', [HeroVideosController::class, 'heroVideosIndex']);
$app->router->get('/heroVideos/build', [HeroVideosController::class, 'heroVideosBuild']);
$app->router->post('/heroVideos/build', [HeroVideosController::class, 'heroVideosRecord']);
$app->router->get('/heroVideos/{heroVideosIdentify}/destroy', [HeroVideosController::class, 'heroVideosDestroy']);
$app->router->get('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosModify']);
$app->router->post('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosEdit']);
$app->router->get('/heroVideos/{heroVideosIdentify}', [HeroVideosController::class, 'heroVideosDisplay']);

// heroVideos of routes
$app->router->get('/heroVideos', [HeroVideosController::class, 'heroVideosIndex']);
$app->router->get('/heroVideos/build', [HeroVideosController::class, 'heroVideosBuild']);
$app->router->post('/heroVideos/build', [HeroVideosController::class, 'heroVideosRecord']);
$app->router->get('/heroVideos/{heroVideosIdentify}/destroy', [HeroVideosController::class, 'heroVideosDestroy']);
$app->router->get('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosModify']);
$app->router->post('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosEdit']);
$app->router->get('/heroVideos/{heroVideosIdentify}', [HeroVideosController::class, 'heroVideosDisplay']);

// heroVideos of routes
$app->router->get('/heroVideos', [HeroVideosController::class, 'heroVideosIndex']);
$app->router->get('/heroVideos/build', [HeroVideosController::class, 'heroVideosBuild']);
$app->router->post('/heroVideos/build', [HeroVideosController::class, 'heroVideosRecord']);
$app->router->get('/heroVideos/{heroVideosIdentify}/destroy', [HeroVideosController::class, 'heroVideosDestroy']);
$app->router->get('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosModify']);
$app->router->post('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosEdit']);
$app->router->get('/heroVideos/{heroVideosIdentify}', [HeroVideosController::class, 'heroVideosDisplay']);

// heroVideos of routes
$app->router->get('/heroVideos', [HeroVideosController::class, 'heroVideosIndex']);
$app->router->get('/heroVideos/build', [HeroVideosController::class, 'heroVideosBuild']);
$app->router->post('/heroVideos/build', [HeroVideosController::class, 'heroVideosRecord']);
$app->router->get('/heroVideos/{heroVideosIdentify}/destroy', [HeroVideosController::class, 'heroVideosDestroy']);
$app->router->get('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosModify']);
$app->router->post('/heroVideos/{heroVideosIdentify}/modify', [HeroVideosController::class, 'heroVideosEdit']);
$app->router->get('/heroVideos/{heroVideosIdentify}', [HeroVideosController::class, 'heroVideosDisplay']);

// orders of routes
$app->router->get('/orders', [OrdersController::class, 'ordersIndex']);
$app->router->get('/orders/build', [OrdersController::class, 'ordersBuild']);
$app->router->post('/orders/build', [OrdersController::class, 'ordersRecord']);
$app->router->get('/orders/{ordersIdentify}/destroy', [OrdersController::class, 'ordersDestroy']);
$app->router->get('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersModify']);
$app->router->post('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersEdit']);
$app->router->get('/orders/{ordersIdentify}', [OrdersController::class, 'ordersDisplay']);

// orders of routes
$app->router->get('/orders', [OrdersController::class, 'ordersIndex']);
$app->router->get('/orders/build', [OrdersController::class, 'ordersBuild']);
$app->router->post('/orders/build', [OrdersController::class, 'ordersRecord']);
$app->router->get('/orders/{ordersIdentify}/destroy', [OrdersController::class, 'ordersDestroy']);
$app->router->get('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersModify']);
$app->router->post('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersEdit']);
$app->router->get('/orders/{ordersIdentify}', [OrdersController::class, 'ordersDisplay']);

// orders of routes
$app->router->get('/orders', [OrdersController::class, 'ordersIndex']);
$app->router->get('/orders/build', [OrdersController::class, 'ordersBuild']);
$app->router->post('/orders/build', [OrdersController::class, 'ordersRecord']);
$app->router->get('/orders/{ordersIdentify}/destroy', [OrdersController::class, 'ordersDestroy']);
$app->router->get('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersModify']);
$app->router->post('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersEdit']);
$app->router->get('/orders/{ordersIdentify}', [OrdersController::class, 'ordersDisplay']);

// orders of routes
$app->router->get('/orders', [OrdersController::class, 'ordersIndex']);
$app->router->get('/orders/build', [OrdersController::class, 'ordersBuild']);
$app->router->post('/orders/build', [OrdersController::class, 'ordersRecord']);
$app->router->get('/orders/{ordersIdentify}/destroy', [OrdersController::class, 'ordersDestroy']);
$app->router->get('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersModify']);
$app->router->post('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersEdit']);
$app->router->get('/orders/{ordersIdentify}', [OrdersController::class, 'ordersDisplay']);

// orders of routes
$app->router->get('/orders', [OrdersController::class, 'ordersIndex']);
$app->router->get('/orders/build', [OrdersController::class, 'ordersBuild']);
$app->router->post('/orders/build', [OrdersController::class, 'ordersRecord']);
$app->router->get('/orders/{ordersIdentify}/destroy', [OrdersController::class, 'ordersDestroy']);
$app->router->get('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersModify']);
$app->router->post('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersEdit']);
$app->router->get('/orders/{ordersIdentify}', [OrdersController::class, 'ordersDisplay']);

// orders of routes
$app->router->get('/orders', [OrdersController::class, 'ordersIndex']);
$app->router->get('/orders/build', [OrdersController::class, 'ordersBuild']);
$app->router->post('/orders/build', [OrdersController::class, 'ordersRecord']);
$app->router->get('/orders/{ordersIdentify}/destroy', [OrdersController::class, 'ordersDestroy']);
$app->router->get('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersModify']);
$app->router->post('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersEdit']);
$app->router->get('/orders/{ordersIdentify}', [OrdersController::class, 'ordersDisplay']);

// orders of routes
$app->router->get('/orders', [OrdersController::class, 'ordersIndex']);
$app->router->get('/orders/build', [OrdersController::class, 'ordersBuild']);
$app->router->post('/orders/build', [OrdersController::class, 'ordersRecord']);
$app->router->get('/orders/{ordersIdentify}/destroy', [OrdersController::class, 'ordersDestroy']);
$app->router->get('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersModify']);
$app->router->post('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersEdit']);
$app->router->get('/orders/{ordersIdentify}', [OrdersController::class, 'ordersDisplay']);

// code of routes
$app->router->get('/code', [CodeController::class, 'codeIndex']);
$app->router->get('/code/build', [CodeController::class, 'codeBuild']);
$app->router->post('/code/build', [CodeController::class, 'codeRecord']);
$app->router->get('/code/{codeIdentify}/destroy', [CodeController::class, 'codeDestroy']);
$app->router->get('/code/{codeIdentify}/modify', [CodeController::class, 'codeModify']);
$app->router->post('/code/{codeIdentify}/modify', [CodeController::class, 'codeEdit']);
$app->router->get('/code/{codeIdentify}', [CodeController::class, 'codeDisplay']);

// orders of routes
$app->router->get('/orders', [OrdersController::class, 'ordersIndex']);
$app->router->get('/orders/build', [OrdersController::class, 'ordersBuild']);
$app->router->post('/orders/build', [OrdersController::class, 'ordersRecord']);
$app->router->get('/orders/{ordersIdentify}/destroy', [OrdersController::class, 'ordersDestroy']);
$app->router->get('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersModify']);
$app->router->post('/orders/{ordersIdentify}/modify', [OrdersController::class, 'ordersEdit']);
$app->router->get('/orders/{ordersIdentify}', [OrdersController::class, 'ordersDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// eventCategories of routes
$app->router->get('/eventCategories', [EventCategoriesController::class, 'eventCategoriesIndex']);
$app->router->get('/eventCategories/build', [EventCategoriesController::class, 'eventCategoriesBuild']);
$app->router->post('/eventCategories/build', [EventCategoriesController::class, 'eventCategoriesRecord']);
$app->router->get('/eventCategories/{eventCategoriesIdentify}/destroy', [EventCategoriesController::class, 'eventCategoriesDestroy']);
$app->router->get('/eventCategories/{eventCategoriesIdentify}/modify', [EventCategoriesController::class, 'eventCategoriesModify']);
$app->router->post('/eventCategories/{eventCategoriesIdentify}/modify', [EventCategoriesController::class, 'eventCategoriesEdit']);
$app->router->get('/eventCategories/{eventCategoriesIdentify}', [EventCategoriesController::class, 'eventCategoriesDisplay']);

// events of routes
$app->router->get('/events', [EventsController::class, 'eventsIndex']);
$app->router->get('/events/build', [EventsController::class, 'eventsBuild']);
$app->router->post('/events/build', [EventsController::class, 'eventsRecord']);
$app->router->get('/events/{eventsIdentify}/destroy', [EventsController::class, 'eventsDestroy']);
$app->router->get('/events/{eventsIdentify}/modify', [EventsController::class, 'eventsModify']);
$app->router->post('/events/{eventsIdentify}/modify', [EventsController::class, 'eventsEdit']);
$app->router->get('/events/{eventsIdentify}', [EventsController::class, 'eventsDisplay']);

// services of routes
$app->router->get('/services', [ServicesController::class, 'servicesIndex']);
$app->router->get('/services/build', [ServicesController::class, 'servicesBuild']);
$app->router->post('/services/build', [ServicesController::class, 'servicesRecord']);
$app->router->get('/services/{servicesIdentify}/destroy', [ServicesController::class, 'servicesDestroy']);
$app->router->get('/services/{servicesIdentify}/modify', [ServicesController::class, 'servicesModify']);
$app->router->post('/services/{servicesIdentify}/modify', [ServicesController::class, 'servicesEdit']);
$app->router->get('/services/{servicesIdentify}', [ServicesController::class, 'servicesDisplay']);

// portfolio of routes
$app->router->get('/portfolio', [PortfolioController::class, 'portfolioIndex']);
$app->router->get('/portfolio/build', [PortfolioController::class, 'portfolioBuild']);
$app->router->post('/portfolio/build', [PortfolioController::class, 'portfolioRecord']);
$app->router->get('/portfolio/{portfolioIdentify}/destroy', [PortfolioController::class, 'portfolioDestroy']);
$app->router->get('/portfolio/{portfolioIdentify}/modify', [PortfolioController::class, 'portfolioModify']);
$app->router->post('/portfolio/{portfolioIdentify}/modify', [PortfolioController::class, 'portfolioEdit']);
$app->router->get('/portfolio/{portfolioIdentify}', [PortfolioController::class, 'portfolioDisplay']);

// clients of routes
$app->router->get('/clients', [ClientsController::class, 'clientsIndex']);
$app->router->get('/clients/build', [ClientsController::class, 'clientsBuild']);
$app->router->post('/clients/build', [ClientsController::class, 'clientsRecord']);
$app->router->get('/clients/{clientsIdentify}/destroy', [ClientsController::class, 'clientsDestroy']);
$app->router->get('/clients/{clientsIdentify}/modify', [ClientsController::class, 'clientsModify']);
$app->router->post('/clients/{clientsIdentify}/modify', [ClientsController::class, 'clientsEdit']);
$app->router->get('/clients/{clientsIdentify}', [ClientsController::class, 'clientsDisplay']);

// testimonials of routes
$app->router->get('/testimonials', [TestimonialsController::class, 'testimonialsIndex']);
$app->router->get('/testimonials/build', [TestimonialsController::class, 'testimonialsBuild']);
$app->router->post('/testimonials/build', [TestimonialsController::class, 'testimonialsRecord']);
$app->router->get('/testimonials/{testimonialsIdentify}/destroy', [TestimonialsController::class, 'testimonialsDestroy']);
$app->router->get('/testimonials/{testimonialsIdentify}/modify', [TestimonialsController::class, 'testimonialsModify']);
$app->router->post('/testimonials/{testimonialsIdentify}/modify', [TestimonialsController::class, 'testimonialsEdit']);
$app->router->get('/testimonials/{testimonialsIdentify}', [TestimonialsController::class, 'testimonialsDisplay']);

// inquiries of routes
$app->router->get('/inquiries', [InquiriesController::class, 'inquiriesIndex']);
$app->router->get('/inquiries/build', [InquiriesController::class, 'inquiriesBuild']);
$app->router->post('/inquiries/build', [InquiriesController::class, 'inquiriesRecord']);
$app->router->get('/inquiries/{inquiriesIdentify}/destroy', [InquiriesController::class, 'inquiriesDestroy']);
$app->router->get('/inquiries/{inquiriesIdentify}/modify', [InquiriesController::class, 'inquiriesModify']);
$app->router->post('/inquiries/{inquiriesIdentify}/modify', [InquiriesController::class, 'inquiriesEdit']);
$app->router->get('/inquiries/{inquiriesIdentify}', [InquiriesController::class, 'inquiriesDisplay']);

// teamMembers of routes
$app->router->get('/teamMembers', [TeamMembersController::class, 'teamMembersIndex']);
$app->router->get('/teamMembers/build', [TeamMembersController::class, 'teamMembersBuild']);
$app->router->post('/teamMembers/build', [TeamMembersController::class, 'teamMembersRecord']);
$app->router->get('/teamMembers/{teamMembersIdentify}/destroy', [TeamMembersController::class, 'teamMembersDestroy']);
$app->router->get('/teamMembers/{teamMembersIdentify}/modify', [TeamMembersController::class, 'teamMembersModify']);
$app->router->post('/teamMembers/{teamMembersIdentify}/modify', [TeamMembersController::class, 'teamMembersEdit']);
$app->router->get('/teamMembers/{teamMembersIdentify}', [TeamMembersController::class, 'teamMembersDisplay']);

// blogPosts of routes
$app->router->get('/blogPosts', [BlogPostsController::class, 'blogPostsIndex']);
$app->router->get('/blogPosts/build', [BlogPostsController::class, 'blogPostsBuild']);
$app->router->post('/blogPosts/build', [BlogPostsController::class, 'blogPostsRecord']);
$app->router->get('/blogPosts/{blogPostsIdentify}/destroy', [BlogPostsController::class, 'blogPostsDestroy']);
$app->router->get('/blogPosts/{blogPostsIdentify}/modify', [BlogPostsController::class, 'blogPostsModify']);
$app->router->post('/blogPosts/{blogPostsIdentify}/modify', [BlogPostsController::class, 'blogPostsEdit']);
$app->router->get('/blogPosts/{blogPostsIdentify}', [BlogPostsController::class, 'blogPostsDisplay']);

// faqs of routes
$app->router->get('/faqs', [FaqsController::class, 'faqsIndex']);
$app->router->get('/faqs/build', [FaqsController::class, 'faqsBuild']);
$app->router->post('/faqs/build', [FaqsController::class, 'faqsRecord']);
$app->router->get('/faqs/{faqsIdentify}/destroy', [FaqsController::class, 'faqsDestroy']);
$app->router->get('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsModify']);
$app->router->post('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsEdit']);
$app->router->get('/faqs/{faqsIdentify}', [FaqsController::class, 'faqsDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// faqs of routes
$app->router->get('/faqs', [FaqsController::class, 'faqsIndex']);
$app->router->get('/faqs/build', [FaqsController::class, 'faqsBuild']);
$app->router->post('/faqs/build', [FaqsController::class, 'faqsRecord']);
$app->router->get('/faqs/{faqsIdentify}/destroy', [FaqsController::class, 'faqsDestroy']);
$app->router->get('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsModify']);
$app->router->post('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsEdit']);
$app->router->get('/faqs/{faqsIdentify}', [FaqsController::class, 'faqsDisplay']);

// faqs of routes
$app->router->get('/faqs', [FaqsController::class, 'faqsIndex']);
$app->router->get('/faqs/build', [FaqsController::class, 'faqsBuild']);
$app->router->post('/faqs/build', [FaqsController::class, 'faqsRecord']);
$app->router->get('/faqs/{faqsIdentify}/destroy', [FaqsController::class, 'faqsDestroy']);
$app->router->get('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsModify']);
$app->router->post('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsEdit']);
$app->router->get('/faqs/{faqsIdentify}', [FaqsController::class, 'faqsDisplay']);

// faqs of routes
$app->router->get('/faqs', [FaqsController::class, 'faqsIndex']);
$app->router->get('/faqs/build', [FaqsController::class, 'faqsBuild']);
$app->router->post('/faqs/build', [FaqsController::class, 'faqsRecord']);
$app->router->get('/faqs/{faqsIdentify}/destroy', [FaqsController::class, 'faqsDestroy']);
$app->router->get('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsModify']);
$app->router->post('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsEdit']);
$app->router->get('/faqs/{faqsIdentify}', [FaqsController::class, 'faqsDisplay']);

// faqs of routes
$app->router->get('/faqs', [FaqsController::class, 'faqsIndex']);
$app->router->get('/faqs/build', [FaqsController::class, 'faqsBuild']);
$app->router->post('/faqs/build', [FaqsController::class, 'faqsRecord']);
$app->router->get('/faqs/{faqsIdentify}/destroy', [FaqsController::class, 'faqsDestroy']);
$app->router->get('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsModify']);
$app->router->post('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsEdit']);
$app->router->get('/faqs/{faqsIdentify}', [FaqsController::class, 'faqsDisplay']);

// faqs of routes
$app->router->get('/faqs', [FaqsController::class, 'faqsIndex']);
$app->router->get('/faqs/build', [FaqsController::class, 'faqsBuild']);
$app->router->post('/faqs/build', [FaqsController::class, 'faqsRecord']);
$app->router->get('/faqs/{faqsIdentify}/destroy', [FaqsController::class, 'faqsDestroy']);
$app->router->get('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsModify']);
$app->router->post('/faqs/{faqsIdentify}/modify', [FaqsController::class, 'faqsEdit']);
$app->router->get('/faqs/{faqsIdentify}', [FaqsController::class, 'faqsDisplay']);

// post of routes
$app->router->get('/post', [PostController::class, 'postIndex']);
$app->router->get('/post/build', [PostController::class, 'postBuild']);
$app->router->post('/post/build', [PostController::class, 'postRecord']);
$app->router->get('/post/{postIdentify}/destroy', [PostController::class, 'postDestroy']);
$app->router->get('/post/{postIdentify}/modify', [PostController::class, 'postModify']);
$app->router->post('/post/{postIdentify}/modify', [PostController::class, 'postEdit']);
$app->router->get('/post/{postIdentify}', [PostController::class, 'postDisplay']);

// post of routes
$app->router->get('/post', [PostController::class, 'postIndex']);
$app->router->get('/post/build', [PostController::class, 'postBuild']);
$app->router->post('/post/build', [PostController::class, 'postRecord']);
$app->router->get('/post/{postIdentify}/destroy', [PostController::class, 'postDestroy']);
$app->router->get('/post/{postIdentify}/modify', [PostController::class, 'postModify']);
$app->router->post('/post/{postIdentify}/modify', [PostController::class, 'postEdit']);
$app->router->get('/post/{postIdentify}', [PostController::class, 'postDisplay']);

// post of routes
$app->router->get('/post', [PostController::class, 'postIndex']);
$app->router->get('/post/build', [PostController::class, 'postBuild']);
$app->router->post('/post/build', [PostController::class, 'postRecord']);
$app->router->get('/post/{postIdentify}/destroy', [PostController::class, 'postDestroy']);
$app->router->get('/post/{postIdentify}/modify', [PostController::class, 'postModify']);
$app->router->post('/post/{postIdentify}/modify', [PostController::class, 'postEdit']);
$app->router->get('/post/{postIdentify}', [PostController::class, 'postDisplay']);

// post of routes
$app->router->get('/post', [PostController::class, 'postIndex']);
$app->router->get('/post/build', [PostController::class, 'postBuild']);
$app->router->post('/post/build', [PostController::class, 'postRecord']);
$app->router->get('/post/{postIdentify}/destroy', [PostController::class, 'postDestroy']);
$app->router->get('/post/{postIdentify}/modify', [PostController::class, 'postModify']);
$app->router->post('/post/{postIdentify}/modify', [PostController::class, 'postEdit']);
$app->router->get('/post/{postIdentify}', [PostController::class, 'postDisplay']);

// post of routes
$app->router->get('/post', [PostController::class, 'postIndex']);
$app->router->get('/post/build', [PostController::class, 'postBuild']);
$app->router->post('/post/build', [PostController::class, 'postRecord']);
$app->router->get('/post/{postIdentify}/destroy', [PostController::class, 'postDestroy']);
$app->router->get('/post/{postIdentify}/modify', [PostController::class, 'postModify']);
$app->router->post('/post/{postIdentify}/modify', [PostController::class, 'postEdit']);
$app->router->get('/post/{postIdentify}', [PostController::class, 'postDisplay']);

// post of routes
$app->router->get('/post', [PostController::class, 'postIndex']);
$app->router->get('/post/build', [PostController::class, 'postBuild']);
$app->router->post('/post/build', [PostController::class, 'postRecord']);
$app->router->get('/post/{postIdentify}/destroy', [PostController::class, 'postDestroy']);
$app->router->get('/post/{postIdentify}/modify', [PostController::class, 'postModify']);
$app->router->post('/post/{postIdentify}/modify', [PostController::class, 'postEdit']);
$app->router->get('/post/{postIdentify}', [PostController::class, 'postDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// post of routes
$app->router->get('/post', [PostController::class, 'postIndex']);
$app->router->get('/post/build', [PostController::class, 'postBuild']);
$app->router->post('/post/build', [PostController::class, 'postRecord']);
$app->router->get('/post/{postIdentify}/destroy', [PostController::class, 'postDestroy']);
$app->router->get('/post/{postIdentify}/modify', [PostController::class, 'postModify']);
$app->router->post('/post/{postIdentify}/modify', [PostController::class, 'postEdit']);
$app->router->get('/post/{postIdentify}', [PostController::class, 'postDisplay']);

// post of routes
$app->router->get('/post', [PostController::class, 'postIndex']);
$app->router->get('/post/build', [PostController::class, 'postBuild']);
$app->router->post('/post/build', [PostController::class, 'postRecord']);
$app->router->get('/post/{postIdentify}/destroy', [PostController::class, 'postDestroy']);
$app->router->get('/post/{postIdentify}/modify', [PostController::class, 'postModify']);
$app->router->post('/post/{postIdentify}/modify', [PostController::class, 'postEdit']);
$app->router->get('/post/{postIdentify}', [PostController::class, 'postDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// category of routes
$app->router->get('/category', [CategoryController::class, 'categoryIndex']);
$app->router->get('/category/build', [CategoryController::class, 'categoryBuild']);
$app->router->post('/category/build', [CategoryController::class, 'categoryRecord']);
$app->router->get('/category/{categoryIdentify}/destroy', [CategoryController::class, 'categoryDestroy']);
$app->router->get('/category/{categoryIdentify}/modify', [CategoryController::class, 'categoryModify']);
$app->router->post('/category/{categoryIdentify}/modify', [CategoryController::class, 'categoryEdit']);
$app->router->get('/category/{categoryIdentify}', [CategoryController::class, 'categoryDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// categories of routes
$app->router->get('/categories', [CategoriesController::class, 'categoriesIndex']);
$app->router->get('/categories/build', [CategoriesController::class, 'categoriesBuild']);
$app->router->post('/categories/build', [CategoriesController::class, 'categoriesRecord']);
$app->router->get('/categories/{categoriesIdentify}/destroy', [CategoriesController::class, 'categoriesDestroy']);
$app->router->get('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesModify']);
$app->router->post('/categories/{categoriesIdentify}/modify', [CategoriesController::class, 'categoriesEdit']);
$app->router->get('/categories/{categoriesIdentify}', [CategoriesController::class, 'categoriesDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// dimention of routes
$app->router->get('/dimention', [DimentionController::class, 'dimentionIndex']);
$app->router->get('/dimention/build', [DimentionController::class, 'dimentionBuild']);
$app->router->post('/dimention/build', [DimentionController::class, 'dimentionRecord']);
$app->router->get('/dimention/{dimentionIdentify}/destroy', [DimentionController::class, 'dimentionDestroy']);
$app->router->get('/dimention/{dimentionIdentify}/modify', [DimentionController::class, 'dimentionModify']);
$app->router->post('/dimention/{dimentionIdentify}/modify', [DimentionController::class, 'dimentionEdit']);
$app->router->get('/dimention/{dimentionIdentify}', [DimentionController::class, 'dimentionDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// media of routes
$app->router->get('/media', [MediaController::class, 'mediaIndex']);
$app->router->get('/media/build', [MediaController::class, 'mediaBuild']);
$app->router->post('/media/build', [MediaController::class, 'mediaRecord']);
$app->router->get('/media/{mediaIdentify}/destroy', [MediaController::class, 'mediaDestroy']);
$app->router->get('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaModify']);
$app->router->post('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaEdit']);
$app->router->get('/media/{mediaIdentify}', [MediaController::class, 'mediaDisplay']);

// media of routes
$app->router->get('/media', [MediaController::class, 'mediaIndex']);
$app->router->get('/media/build', [MediaController::class, 'mediaBuild']);
$app->router->post('/media/build', [MediaController::class, 'mediaRecord']);
$app->router->get('/media/{mediaIdentify}/destroy', [MediaController::class, 'mediaDestroy']);
$app->router->get('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaModify']);
$app->router->post('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaEdit']);
$app->router->get('/media/{mediaIdentify}', [MediaController::class, 'mediaDisplay']);

// media of routes
$app->router->get('/media', [MediaController::class, 'mediaIndex']);
$app->router->get('/media/build', [MediaController::class, 'mediaBuild']);
$app->router->post('/media/build', [MediaController::class, 'mediaRecord']);
$app->router->get('/media/{mediaIdentify}/destroy', [MediaController::class, 'mediaDestroy']);
$app->router->get('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaModify']);
$app->router->post('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaEdit']);
$app->router->get('/media/{mediaIdentify}', [MediaController::class, 'mediaDisplay']);

// media of routes
$app->router->get('/media', [MediaController::class, 'mediaIndex']);
$app->router->get('/media/build', [MediaController::class, 'mediaBuild']);
$app->router->post('/media/build', [MediaController::class, 'mediaRecord']);
$app->router->get('/media/{mediaIdentify}/destroy', [MediaController::class, 'mediaDestroy']);
$app->router->get('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaModify']);
$app->router->post('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaEdit']);
$app->router->get('/media/{mediaIdentify}', [MediaController::class, 'mediaDisplay']);

// media of routes
$app->router->get('/media', [MediaController::class, 'mediaIndex']);
$app->router->get('/media/build', [MediaController::class, 'mediaBuild']);
$app->router->post('/media/build', [MediaController::class, 'mediaRecord']);
$app->router->get('/media/{mediaIdentify}/destroy', [MediaController::class, 'mediaDestroy']);
$app->router->get('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaModify']);
$app->router->post('/media/{mediaIdentify}/modify', [MediaController::class, 'mediaEdit']);
$app->router->get('/media/{mediaIdentify}', [MediaController::class, 'mediaDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);

// product of routes
$app->router->get('/product', [ProductController::class, 'productIndex']);
$app->router->get('/product/build', [ProductController::class, 'productBuild']);
$app->router->post('/product/build', [ProductController::class, 'productRecord']);
$app->router->get('/product/{productIdentify}/destroy', [ProductController::class, 'productDestroy']);
$app->router->get('/product/{productIdentify}/modify', [ProductController::class, 'productModify']);
$app->router->post('/product/{productIdentify}/modify', [ProductController::class, 'productEdit']);
$app->router->get('/product/{productIdentify}', [ProductController::class, 'productDisplay']);
