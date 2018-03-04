Для запуска проекта:
1) cd <path-to-project>
2) cd public
3) php -S localhost:8000
4) в CLI введите текст для проверки
5) в браузере проверьте результат

Для запуска тестов:
1) cd <path-to-project>
2) ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/TextWizardTest
   ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/TextMasterTest
3) в CLI проверьте результат