<?php

namespace Framework59;
class Kernel {
    
    protected static $commands = [];
    
    public static function add(array $options, callable $callback = null) {
        if(empty($options) || !isset($options['category']) || !isset($options['name']) || !isset($options['description'])) return 'Options must contain atleast a category, description and a name';
        $options['callback'] = $callback;
        self::$commands[$options['category']][$options['name']] = $options;
    }

    public static function help() {
        print_r(self::printColor("Framework59 Kernel PHP\n\n\n", 'green'));
        foreach(self::$commands as $index => $command) {
            print_r(self::printColor(ucfirst($index) . "\n", 'blue'));
            foreach($command as $val) {
                print_r(self::printColor('   ' . ucfirst($val['name']) . '      :      ' . $val['description'] . "\n", 'light blue'));
            }
        }
    }

    public static function execute(array $command, $data = null) {
        if(isset(self::$commands[ucfirst($command[0])])) {
            $callback = self::$commands[ucfirst($command[0])][$command[1]]['callback'];
            $callback($data);
            return;
        }       
    }

    public static function stubCommand(string $stub, array $keywords) {
        if(!file_exists('./app/stubs/' . $stub . '.stub')) return false;
        $file = file_get_contents('./app/stubs/' . $stub . '.stub');

        $arr = explode(' ', $file);
        $i = 0;
        foreach($arr as $word) {
            foreach($keywords as $key => $value) {
                if($word == $key) {
                    $arr[$i] = $value;
                }
            }
            $i++;
        }

        return implode(' ', $arr);
        
    }

    // this method requires one variable. the second, color, is optional
    public static function printColor($content, $color=null)
    {
        
        // if a color is set use the color set.
        if(!empty($color))
        {
            // if our color string is not a numeric value
            if(!is_numeric($color))
            {
                    //lowercase our string value.
                    $c = strtolower($color);
                
            }
            else
                {   
                    // check if our color value is not empty.
                    if(!empty($color))
                    {
                        
                        $c = $color;
                    
                    }
                    else
                        { 
                            // no color was set so lets pick a random one...
                            $c = rand(1,14);
                            
                        }
                    
                }
                
        }
        else    // no color argument was passed, so lets pick a random one w00t
            { 
                
                $c = rand(1,14);
                            
            }
        
        $cheader = '';
        $cfooter = "\033[0m";
        
        // let check which color code was used so we can then wrap our content.
        switch($c)
        {
                    
            case 1:
            case 'red':
                
                // color code header.
                $cheader .= "\033[31m";

            break;
            
            case 2:
            case 'green':
                
                // color code header.
                $cheader .= "\033[32m";

            break;

            case 3:
            case 'yellow':
                
                // color code header.
                $cheader .= "\033[33m";

            break;
            
            case 4:
            case 'blue':
                
                // color code header.
                $cheader .= "\033[34m";

            break;
            
            case 5:
            case 'magenta':
                
                // color code header.
                $cheader .= "\033[35m";

            break;
            
            case 6:
            case 'cyan':
                
                // color code header.
                $cheader .= "\033[36m";

            break;
            
            case 7:
            case 'light grey':
                
                // color code header.
                $cheader .= "\033[37m";

            break;
            
            case 8:
            case 'dark grey':
                
                // color code header.
                $cheader .= "\033[90m";

            break;
            
            case 9:
            case 'light red':
                
                // color code header.
                $cheader .= "\033[91m";

            break;
            
            case 10:
            case 'light green':
                
                // color code header.
                $cheader .= "\033[92m";

            break;
            
            case 11:
            case 'light yellow':
                
                // color code header.
                $cheader .= "\033[93m";

            break;
            
            case 12:
            case 'light blue':
                
                // color code header.
                $cheader .= "\033[94m";

            break;
            
            case 13:
            case 'light magenta':
                
                // color code header.
                $cheader .= "\033[95m";

            break;
            
            case 14:
            case 'light cyan':
                
                // color code header.
                $cheader .= "\033[92m";

            break;
            
        }
          
        // wrap our content.
        $content = $cheader.$content.$cfooter;
        
        //return our new content.
        return $content;
        

    }

}