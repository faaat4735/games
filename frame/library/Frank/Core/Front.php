<?php 
class Front {
    /**
     * Dispatch
     *
     * @param string $controllerName
     * @param string $actionName
     * @return mixed|false
     */
    public function dispatch($controllerName = null, $actionName = null)
    {
        //实例化分发器时得到用户请求的URI 
        $paths = trim($_SERVER['REQUEST_URI'], '/');
        //分析URI，得到相应的控制器和方法
        $paths = explode('/', $paths);

        //得到控制器类名和方法名
        $controllerName = array_shift($paths);
        $actionName = array_shift($paths);

        $controllerClassName = $this->formatControllerName($controllerName);
        $actionMethodName = $this->formatActionName($actionName);
        try {
            $result = $this->find($controllerClassName, $actionMethodName);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
        
    }

    /**
     * Process the result
     * You can override it
     *
     * @param ModelInterface|array|\Traversable|false|null $result
     * @return echo
     */
    public function run($result)
    {
        $template = TPL_DIR . 'Index' . '/' . 'index' . '.html';
        echo $this->render($result, $template);
    }

    public function find($controllerClassName, $actionMethodName)
    {
        //根据框架的文件结构，得到控制器类的文件路径
        // $control_file_name = ROOT_PATH.'/controller/'.$control.'.php';
        $control_file_name = CLASS_DIR . $controllerClassName . '.class.php';
        if(!file_exists($control_file_name)){
            throw new Exception('不存在control');
            return false;
        }
        $controller = new $controllerClassName();
        if (!method_exists($controller, $actionMethodName)) {

        }
        return $controller->$actionMethodName();
    }


    /**
     * Format a controller name
     * e.g. default-name => DefaultNameController
     *
     * @param string $controllerName
     * @return string
     */
    public function formatControllerName($controllerName)
    {
        if (empty($controllerName)) {
            return null;
        }
        $controllerName = ucfirst(strtolower($controllerName));
        // return WordConvertor::dashToCamelCase($controllerName) . 'Controller';
        return $controllerName;
    }

    /**
     * Format a action name
     * e.g. action-name => actionNameAction
     *
     * @param string $actionName
     * @return string
     */
    public function formatActionName($actionName)
    {
        if (empty($actionName)) {
            return null;
        }
        $actionName = strtolower($actionName);
        // return WordConvertor::dashToCamelCase($actionName, true) . 'Action';
        return $actionName;
    }

    public function render($variables)
    {
        extract($variables, EXTR_SKIP); // Extract the variables to a local namespace
        ob_start(); // Start output buffering
        include func_get_arg(1); // Include the template file
        $contents = ob_get_clean(); // Get the contents of the buffe;
        return $contents; // Return the contents
    }
        //如果控制器类名和方法名为空，则默认为“index”
        // if($control == '') $control = 'index';
        // if($method == '') $method= 'index';

        // //根据框架的文件结构，得到控制器类的文件路径
        // $control_file_name = ROOT_PATH.'/controller/'.$control.'.php';

        // if(file_exists($control_file_name))
        // {
        //     include_once($control_file_name);

        //     $controller_name = $control.'_Controller';
        //     if(class_exists($controller_name))
        //     {
        //         //实例化控制器
        //         $control = new $controller_name();
        //         if(method_exists($controller_name, $method))
        //         {
        //             //如果用户请求的方法存在，则调用之
        //             $control->$method();
        //             return OK_200;
        //         }
        //         else return ERROR_404;
        //     }
        //     else return ERROR_404;
        // }
        // else return ERROR_404;

}
?>