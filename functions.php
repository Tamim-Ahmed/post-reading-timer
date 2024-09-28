// Post Reading Timer 
// Function to estimate reading time
function estimate_reading_time($text, $wpm = 200) {
    // Remove HTML tags and normalize whitespace
    $cleanedText = strip_tags($text);
    $cleanedText = preg_replace('/\s+/', ' ', $cleanedText);
    $wordCount = str_word_count($cleanedText); // Count words

    $estimatedTime = ceil($wordCount / $wpm); // Round up to nearest minute
    return ($estimatedTime == 1) ? '1 Min' : $estimatedTime . ' Min'; // Return formatted result
}

// Shortcode function for estimated reading time
function shortcode_reading_time() {
    global $post; // Access the global post object

    if (isset($post) && !empty($post->post_content)) {
        // Retrieve the entire post content and apply standard WordPress filters
        $full_content = apply_filters('the_content', $post->post_content);
        $reading_time = estimate_reading_time($full_content); // Calculate reading time

        return "$reading_time Read"; // Return formatted reading time
    } else {
        return '0 Min'; // Return empty if the post is not set or has no content
    }
}

// Register the shortcode
add_shortcode('reading_time', 'shortcode_reading_time');

// Shortcode is : [reading_time]
