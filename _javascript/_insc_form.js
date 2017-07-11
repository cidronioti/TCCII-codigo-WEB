		<script type="text/javascript">/*essa parte de java script he o texto q esta com efeito não sobrepor o texto informado pelo usuario mas não ta funcionando*/
			$(document).ready(function(){
				$('input').blur(function(){
					if($(this).val())
						$(this).addClass('used');
					else
						$(this).removeClass('used');
				});
			});
		</script>