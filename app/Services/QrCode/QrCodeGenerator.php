<?php

namespace App\Services\QrCode;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Eye\EyeInterface;
use BaconQrCode\Renderer\Eye\ModuleEye;
use BaconQrCode\Renderer\Eye\PointyEye;
use BaconQrCode\Renderer\Eye\SimpleCircleEye;
use BaconQrCode\Renderer\Eye\SquareEye;
use BaconQrCode\Renderer\Image\GdImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Module\DotsModule;
use BaconQrCode\Renderer\Module\ModuleInterface;
use BaconQrCode\Renderer\Module\RoundnessModule;
use BaconQrCode\Renderer\Module\SquareModule;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use InvalidArgumentException;

class QrCodeGenerator
{
    /**
     * Generate a QR code at the given file path.
     *
     * @param  array{
     *     size?: int,
     *     margin?: int,
     *     color?: array{red:int,green:int,blue:int},
     *     background?: array{red:int,green:int,blue:int},
     *     style?: string,
     *     eye?: string,
     *     error_correction?: string
     * }  $options
     */
    public function generate(string $content, string $filePath, array $options = []): void
    {
        $size = (int) ($options['size'] ?? 250);
        $margin = (int) ($options['margin'] ?? 0);
        $color = $options['color'] ?? ['red' => 0, 'green' => 0, 'blue' => 0];
        $background = $options['background'] ?? ['red' => 255, 'green' => 255, 'blue' => 255];
        $style = $options['style'] ?? 'square';
        $eyeStyle = $options['eye'] ?? 'square';
        $errorCorrection = strtoupper($options['error_correction'] ?? 'H');

        $module = $this->resolveModule($style);
        $eye = $this->resolveEye($eyeStyle, $module);
        $fill = Fill::uniformColor(
            new Rgb($background['red'], $background['green'], $background['blue']),
            new Rgb($color['red'], $color['green'], $color['blue'])
        );

        $rendererStyle = new RendererStyle($size, $margin, $module, $eye, $fill);
        $writer = new Writer(new ImageRenderer($rendererStyle, new GdImageBackEnd()));

        $writer->writeFile(
            $content,
            $filePath,
            null,
            $this->mapErrorCorrection($errorCorrection)
        );
    }

    protected function resolveModule(string $style): ModuleInterface
    {
        return match ($style) {
            'dot', 'dots' => new DotsModule(DotsModule::MEDIUM),
            'rounded', 'round' => new RoundnessModule(RoundnessModule::MEDIUM),
            default => SquareModule::instance(),
        };
    }

    protected function resolveEye(string $style, ModuleInterface $module): EyeInterface
    {
        return match ($style) {
            'circle' => SimpleCircleEye::instance(),
            'pointy' => PointyEye::instance(),
            default => $module instanceof SquareModule
                ? SquareEye::instance()
                : new ModuleEye($module),
        };
    }

    protected function mapErrorCorrection(string $level): ErrorCorrectionLevel
    {
        return match ($level) {
            'L' => ErrorCorrectionLevel::L(),
            'M' => ErrorCorrectionLevel::M(),
            'Q' => ErrorCorrectionLevel::Q(),
            'H' => ErrorCorrectionLevel::H(),
            default => throw new InvalidArgumentException('Unsupported error correction level.')
        };
    }
}



