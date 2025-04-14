<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileTypeValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

     protected $extensions;

    public function __construct($extensions)
    {
        $this->extensions = $extensions;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function passes($value, $attribute)
    {
        /*
            How to correctelly instanciate a file validation
                'form_field' => [new FileTypeValidationRule(['accepted_files'])]
        */

        /* Array of headers and sizes */
        $headers = [
            ["jpg", [32, "JFIF"]],
            ["jpeg", [32, "JFIF"]],
            ["pdf", [8, "PDF"]],
            ["png", [8, "PNG"]],
            ["zip", [8, "PK"]],
            ["docx", [8, "PK"]],
            ["db", [8, "SQLI"]],
        ];

        /* Open file as binary */
        $fileBinary = fopen($attribute, 'rb');

        /* Iterate the array of known extensions to check file */
        foreach($headers as $header){

            /* Checks if the inputed header is on the $headers array */
            if(in_array($header[0], $this->extensions)){

                /* Go to file 0 index byte */
                fseek($fileBinary, 0);

                /* Read the given amount of bytes  */
                $fileHeader = fread($fileBinary, $header[1][0]);

                /* Checks if the file header contains the string identification */
                if(strpos($fileHeader, $header[1][1])){

                    /* Close the binary file and return true if the file header passed */
                    fclose($fileBinary);
                    return true;

                }
            }
        }

        /* Close the binary file and return false if the file header didn't pass */
        fclose($fileBinary);
        return false;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O arquivo deve ter o formato {{ accepted formats }}';
    }
}
