<?php

 namespace Visionet\PhoneNumber\Setup;

 use Magento\Eav\Setup\EavSetup;
 use Magento\Eav\Setup\EavSetupFactory;
 use Magento\Framework\Setup\InstallDataInterface;
 use Magento\Framework\Setup\ModuleContextInterface;
 use Magento\Framework\Setup\ModuleDataSetupInterface;

 class Uninstall implements InstallDataInterface
 {
 private $eavSetupFactory;

 public function __construct(EavSetupFactory $eavSetupFactory) 
 {
 $this->eavSetupFactory = $eavSetupFactory;
 }

 public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
 {

 $setup->startSetup();

 $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
 $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY,'phone_number');

 $setup->endSetup();

 }
 }