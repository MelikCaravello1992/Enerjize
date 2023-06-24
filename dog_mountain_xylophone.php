<?php

// Create a class for wearable energy amplifier
class WearableEnergyAmplifier {

  // Define properties for the amplifier
  public $name;
  public $max_output;
  private $connected_devices;
  private $current_output;
  
  // Create a constructor to initialize properties
  public function __construct($name, $max_output) {
    $this->name = $name;
    $this->max_output = $max_output;
    $this->connected_devices = array();
    $this->current_output = 0;
  }
  
  // Method to connect a device
  public function connectDevice($device) {
    // Check if the device is already connected
    if (in_array($device, $this->connected_devices)) {
      echo "Device is already connected!\n";
    }
    else {
      // Connect the device
      array_push($this->connected_devices, $device);
      
      // Increase current output
      $this->current_output += $device->getOutput();
    }
  }
  
  // Method to disconnect a device
  public function disconnectDevice($device) {
    // Check if the device is connected
    if (in_array($device, $this->connected_devices)) {
      // Disconnect the device by removing from the array
      unset($this->connected_devices[array_search($device, $this->connected_devices)]);
      
      // Decrease current output
      $this->current_output -= $device->getOutput();
    }
    else {
      echo "Device is not connected!\n";
    }
  }
  
  // Method to get current output
  public function getCurrentOutput() {
    return $this->current_output;
  }
  
  // Method to check if the amplifier is overloaded
  public function isOverloaded() {
    return $this->current_output > $this->max_output;
  }
}

// Create a class for connected devices
class ConnectedDevice {

  // Define properties for the device
  public $name;
  public $output;
  
  // Create a constructor to initialize properties
  public function __construct($name, $output) {
    $this->name = $name;
    $this->output = $output;
  }
  
  // Method to get the output of the device
  public function getOutput() {
    return $this->output;
  }
}

// Create an instance for the amplifier
$amplifier = new WearableEnergyAmplifier("Amplifier", 8000);

// Create instances for connected devices
$lightBulb = new ConnectedDevice("Light Bulb", 1000);
$phoneCharger = new ConnectedDevice("Phone Charger", 2000);
$laptopCharger = new ConnectedDevice("Laptop Charger", 3000);

// Connect the devices to the amplifier
$amplifier->connectDevice($lightBulb);
$amplifier->connectDevice($phoneCharger);
$amplifier->connectDevice($laptopCharger);

// Get the current output of the amplifier
echo "Current Output: " . $amplifier->getCurrentOutput() . "\n";

// Check if the amplifier is overloaded
if ($amplifier->isOverloaded()) {
  echo "Amplifier is overloaded!\n";
}
else {
  echo "Amplifier is OK!\n";
}

// Disconnect the lighter bulb
$amplifier->disconnectDevice($lightBulb);

// Get the current output of the amplifier
echo "Current Output: " . $amplifier->getCurrentOutput() . "\n";

// Check if the amplifier is overloaded
if ($amplifier->isOverloaded()) {
  echo "Amplifier is overloaded!\n";
}
else {
  echo "Amplifier is OK!\n";
}

?>