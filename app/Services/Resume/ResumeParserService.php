<?php

namespace App\Services\Resume;

use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\ListItem;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextBox;
use PhpOffice\PhpWord\Element\AbstractContainer;

class ResumeParserService
{
    public function extractText(string $filePath, string $extension): string
    {
        $extension = strtolower($extension);

        if ($extension === 'pdf') {
            return $this->extractFromPdf($filePath);
        }

        if (in_array($extension, ['doc', 'docx'])) {
            return $this->extractFromWord($filePath);
        }

        throw new \InvalidArgumentException('Unsupported file type. Use PDF, DOC, or DOCX.');
    }

    // ─────────────────────────────────────────────────────────────
    // PDF
    // ─────────────────────────────────────────────────────────────

    private function extractFromPdf(string $filePath): string
    {
        try {
            $parser = new Parser();
            $pdf    = $parser->parseFile($filePath);
            return $pdf->getText() ?? '';
        } catch (\Throwable $e) {
            throw new \RuntimeException(
                'Failed to parse PDF. The file may be corrupted or password-protected.',
                0, $e
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // Word (DOC / DOCX)
    // ─────────────────────────────────────────────────────────────

    private function extractFromWord(string $filePath): string
    {
        try {
            $phpWord = IOFactory::load($filePath);
            $text    = '';

            foreach ($phpWord->getSections() as $section) {
                $text .= $this->extractFromContainer($section);
            }

            return $text;
        } catch (\Throwable $e) {
            throw new \RuntimeException(
                'Failed to parse Word document. The file may be corrupted or in an unsupported format.',
                0, $e
            );
        }
    }

    /**
     * Recursively extract all text from any container element.
     * ✅ FIX: Now handles Text, TextRun, ListItem, Table, and TextBox —
     *         the original parser only handled Text and TextRun, silently
     *         dropping bullet lists, tables, and text boxes which are
     *         very common in resumes.
     */
    private function extractFromContainer($container): string
    {
        $text = '';

        if (!method_exists($container, 'getElements')) {
            return $text;
        }

        foreach ($container->getElements() as $element) {

            // Plain text node
            if ($element instanceof Text) {
                $text .= $element->getText() . ' ';
                continue;
            }

            // Inline text run (bold, italic, hyperlinks, etc.)
            if ($element instanceof TextRun) {
                $text .= $this->extractFromContainer($element);
                continue;
            }

            // ✅ FIX: Bullet / numbered list items
            if ($element instanceof ListItem) {
                $text .= $this->extractFromContainer($element->getTextObject()) . ' ';
                continue;
            }

            // ✅ FIX: Tables — iterate rows → cells → paragraphs
            if ($element instanceof Table) {
                foreach ($element->getRows() as $row) {
                    foreach ($row->getCells() as $cell) {
                        $text .= $this->extractFromContainer($cell);
                    }
                }
                continue;
            }

            // ✅ FIX: Text boxes and shapes
            if ($element instanceof TextBox) {
                $text .= $this->extractFromContainer($element);
                continue;
            }

            // Generic fallback for any other container element
            if ($element instanceof AbstractContainer) {
                $text .= $this->extractFromContainer($element);
                continue;
            }
        }

        return $text;
    }
}