## NHỮNG THỨ CẦN ĐỤNG

### 1. `app/`

-   `Http/`:
    -   `Controllers/`: Contains application controllers
    -   `Requests/`: Contains form request classes
-   `Models/`: Contains Eloquent models
-   `Providers/`: Contains service providers
-   `Repositories/`: Contains repository classes
-   `Services/`: Contains service classes

### 2. `routes/`

-   `api.php`: API routes

Install composer by Using the Installer: https://getcomposer.org/Composer-Setup.exe
or Manual Installation: https://getcomposer.org/doc/00-intro.md#installation-windows

After installing Composer, set up environment variables:

1. Open Windows Settings
2. Search for "Environment Variables"
3. Click "Environment Variables..."
4. Under "System variables", find and select "Path"
5. Click "Edit"
6. Check if "C:\ProgramData\ComposerSetup\bin" exists
7. If not, click "New" and add "C:\ProgramData\ComposerSetup\bin"
8. Check if ";.PHAR" exists at the end of any Path entry
9. If not, add ";.PHAR" to the end of the appropriate Path entry
10. Click "OK" on all windows to save changes and please restart your computer

B1: Open project in cmd
B2: Git bash: composer install
B3: Run command: php artisan migrate
B4: Run command: php artisan serve
