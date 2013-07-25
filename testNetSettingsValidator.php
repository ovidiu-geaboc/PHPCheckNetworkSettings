<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ovidiu
 * Date: 5/28/13
 * Time: 3:09 PM
 */
require('./NetSettingsValidator.php');
function testNetSettingsValidator($set, $testNo)
{
    //var_dump($set);
    $result = NetSettingsValidator::settingsAreValid($set['ip'], $set['netmask'], $set['gateway'], $set['dns1'], $set['dns2']);
    //assert($result==$set['checks']);
    $testResult = ($result==$set['checks']);
    echo("Test ${testNo} " . (($testResult)?" PASSED":"FAILED!") . "\n");
    return($testResult);
}


function runTests($sets)
{
    $result = TRUE;
    foreach($sets as $k=>$set)
    {
        if(!testNetSettingsValidator($set, $k))
        {
            $result = FALSE;
        }
    }
    return($result);
}


//add test sets here
$sets[] = array('ip' => '192.168.0.2', 'gateway' => '192.168.0.1', 'netmask' => '255.255.255.254', 'dns1' => '192.168.0.1', 'dns2' => '8.8.8.8', 'checks' => FALSE);
$sets[] = array('ip' => '192.168.0.300', 'gateway' => '192.168.0.1', 'netmask' => '255.255.255.254', 'dns1' => '192.168.0.1', 'dns2' => '8.8.8.8', 'checks'=> FALSE);
$sets[] = array('ip' => '192.168.0.2', 'gateway' => '192.168.1.1', 'netmask' => '255.255.252.0', 'dns1' => '192.168.1.1', 'dns2' => '10.1.1.100', 'checks'=> TRUE);
$sets[] = array('ip' => '192.168.0.3', 'gateway' => '192.168.0.1', 'netmask' => '255.255.0.0', 'dns1' => '192.168.0.1', 'dns2' => '10.1.1.1', 'checks'=> TRUE);
$sets[] = array('ip' => '192.168.0.200', 'gateway' => '192.168.1.1', 'netmask' => '255.255.255.0', 'dns1' => '192.168.1.1', 'dns2' => '10.1.1.1', 'checks'=> FALSE);
$sets[] = array('ip' => '192.168.0.18', 'gateway' => '192.168.0.1', 'netmask' => '255.255.255.252', 'dns1' => '192.168.0.1', 'dns2' => '10.1.1.1', 'checks'=> FALSE);
$sets[] = array('ip' => '192.168.0.2', 'gateway' => '192.168.2.100', 'netmask' => '255.255.248.0', 'dns1' => '192.168.0.1', 'dns2' => '10.1.1.1', 'checks'=> TRUE);



//main()
if(runTests($sets))
{
    echo("\nAll test PASSED\n");
}
else
{
    echo("\nTests Failed\n");
}
//