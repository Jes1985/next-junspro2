@echo off
echo Copie de l'image par defaut de la miniature video...
echo.

set "SOURCE=C:\Users\younes\.cursor\projects\c-Users-younes-Downloads-junspro-main-1\assets"
set "DEST=public\assets\img\video-thumbnails\default-video-thumbnail.png"

REM Créer le dossier de destination s'il n'existe pas
if not exist "public\assets\img\video-thumbnails" mkdir "public\assets\img\video-thumbnails"

REM Copier le premier fichier PNG trouvé
for %%f in ("%SOURCE%\*51c2787d*.png") do (
    copy "%%f" "%DEST%" /Y
    echo Image copiee avec succes!
    goto :done
)

echo Fichier source non trouve.
echo Veuillez copier manuellement l'image dans: %DEST%

:done
pause








