<?php

namespace App\Services;

use PhpOffice\PhpPresentation\IOFactory;

class CertificateGeneratorService
{
    public function generate(string $name, string $templateFile): string
    {
        // Load FULL absolute path
        if (!file_exists($templateFile)) {
            throw new \Exception("Template file not found: " . $templateFile);
        }

        $presentation = IOFactory::load($templateFile);

        // foreach ($presentation->getAllSlides() as $slide) {
        //     foreach ($slide->getShapeCollection() as $shape) {
        //         logger()->info('Shape Class: ' . get_class($shape));

        //         if (method_exists($shape, 'getRichTextElements')) {

        //             foreach ($shape->getRichTextElements() as $element) {
        //                 $element->setText(
        //                     str_replace(
        //                         '{{NAME}}',
        //                         $name,
        //                         $element->getText()
        //                     )
        //                 );

        //                 logger()->info('RUN TEXT: ' . $element->getText());
        //             }
        //         }
        //     }
        // }

        foreach ($presentation->getAllSlides() as $slide) {

            foreach ($slide->getShapeCollection() as $shape) {

                // ONLY target RichText shape
                // if (!($shape instanceof RichText)) {
                //     logger()->info('is not RichText');
                //     continue;
                // }

                // ONLY target RichText shape
                if (get_class($shape) !== 'PhpOffice\PhpPresentation\Shape\RichText') {
                    logger()->info('is not RichText: ' . get_class($shape));
                    continue;
                }

                foreach ($shape->getParagraphs() as $paragraph) {
                    logger()->info('is Paragraph');

                    foreach ($paragraph->getRichTextElements() as $element) {

                        if (!method_exists($element, 'getText')) {
                            continue;
                        }

                        logger()->info('getText');

                        $text = $element->getText();

                        // ONLY replace if found in this shape
                        if (strpos($text, '{{NAME}}') !== false) {

                            $element->setText(
                                str_replace('{{NAME}}', $name, $text)
                            );
                        }
                    }
                }
            }
        }

        $dir = storage_path('app/certificates/pptx');

        // Ensure folder exists (VERY IMPORTANT for queue jobs)
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $output = $dir . '/' . str()->slug($name) . '.pptx';

        IOFactory::createWriter($presentation, 'PowerPoint2007')
            ->save($output);

        return $output;
    }
}