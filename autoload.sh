#!/bin/bash

vendor/bin/classmap_generator.php -l module/Application/
vendor/bin/classmap_generator.php -l module/Admin/
vendor/bin/classmap_generator.php -l module/Core/
vendor/bin/classmap_generator.php -l module/Psicologia/
vendor/bin/templatemap_generator.php -l module/Application/ -v module/Application/view/
vendor/bin/templatemap_generator.php -l module/Admin/ -v module/Admin/view/
vendor/bin/templatemap_generator.php -l module/Psicologia/ -v module/Psicologia/view/
