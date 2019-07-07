<?php 

# ===================================
#              SCRIPTS
# ===================================
class Asset
{

    protected $scripts = [];

    /**
    * Get script from content
    *
    * [ .*? ] does mean may be something or not
    *
    * @param string $content
    * @return string
    */
    protected function scriptMap($content)
    {

        # regex
        $pattern = "#<script.*?>.*?</script>#si";

        # if finded matches scripts , we'll add them to $this->>scripts
        preg_match_all($pattern, $content, $this->scripts);

        # if has scripts
        if(!empty($this->scripts))
        {
            # we'll replacae pattenr by empty string in content
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }
}


# Exemple:
$content = file_get_contents(__DIR__.'/views/home/index.php');
$content = $this->scriptMap($content);

echo '<pre>';
print_r($this->scripts);
echo '</pre>';

/*
Array
(
	[0] => Array
	(
			[0] => <script src="/assets/js/test.js"></script>
			[1] => <script>
				$(function () {
					$('#send').click(function () {
						$.ajax({
							url: '/main/test',
							type: 'post',
							data: {'id': 2},
							success: function (res) {
								console.log(res);
							},
							error: function () {
								alert('Error');
							}
						});
					});
				});
			</script>
	)

)
*/