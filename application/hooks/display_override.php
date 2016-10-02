<?php
if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Display_override containts hooks for the display_override hook. Currently,
 * a single hook "bold_all_cap_words()" has been implemented.
 *
 * @author Robert
 */
class Display_override
{
    /**
     * Purpose: Finds all text on the page that is surrounded by the tags
     *          <p class="lead">...</p> and extracts it. Then takes the text
     *          and bolds words that start with a capital letter. After 
     *          bolding each word, the text is re-inserted back inbetween the
     *          tags <p class="lead">...</p> before the page is loaded.
     * 
     * **Note: This function ignores special characters such as a 
     *         quotation before the first letter when checking if the word
     *         starts with a capital letter.
     * 
     * @param type $p_class_lead   - regex check for <p class = "head">...</p>
     * @param type $CI             - gets the instance of the page
     * @param type $current_output - readys the instance of the page to be
     *                               edited
     * @param type $match          - stores the matching text surrounded by
     *                               <p class="lead">...</p>
     * @param type $old_text       - stores each word as its own string from the
     *                               text extracted into $match[1]
     * @param type $new_text       - stores the edited (bolded where
     *                               necessary) text as a single string
     * @param type $space_delim    - delim used to explode the string stored in
     *                               match[1]
     */
    function censor_four_letter_words()
    {
        $p_class_lead   = '/<\s*p class=\"lead\"[^>]*>([^<]*)<\s*\/\s*p\s*>/';
        $CI             = &get_instance();
        $current_output = $CI->output->get_output();
        $match          = array();
        $old_text       = array();  
        $new_text       = '';
        $space_delim    = ' ';
                        
        // if the tag is found
        if (preg_match($p_class_lead, $current_output, $match) )
        {
            $old_text = explode($space_delim, $match[1]); 
            $new_text = $this->replace_with_asterix($old_text);
       
            //inserts the edited text back into the tags <p class="lead>...</p>
            $new_curr = preg_replace($p_class_lead, $new_text, $current_output);
            $CI->output->set_output($new_curr);
            $CI->output->_display();
        }
        else
        {
            $CI->output->_display();
        }
    }
        
    /**
     * Helper function for bold_all_cap_words
     * 
     * Purpose: Takes the array of strings passed in and bolds words that 
     *          start with a capital.
     * 
     * @param type $updated - Edited string to be returned.
     * @param type $para    - The array of strings to be searched.
     * @return string       - The string updated with all capital words bolded.
     */
    private function replace_with_asterix($para)
    {
        $updated = '<p class = "lead">';
        
        foreach ($para as $words)
        {
            // the first letter of $words is not a digit and is capital
			if (preg_match ( '/^[A-Za-z]{4}[^A-Za-z]*$/' , $words)) {
				if(preg_match('/[^A-Za-z]+$/', $words, $matches)){
					$punctuation = $matches[0];
					$updated .= ' ****' . $punctuation;
				} else {
					$updated .= ' ****';
				}
			}
            else
                $updated .= ' ' . $words;
        }
        $updated .= '</p>';
        
        return $updated;
    }
}