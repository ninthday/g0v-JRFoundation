<?php
session_start();

function get_data($url) {
  $ch = curl_init();
  $timeout = 60;
  curl_setopt($ch, CURLOPT_URL, $url);

	$strCookie = session_name()."=".session_id()."; path=".session_save_path();
	echo $strCookie;

	curl_setopt($ch, CURLOPT_COOKIE, $strCookie);

  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, Cvar/wwwURLOPT_SSL_VERIFYHOST,false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);


  $data = curl_exec($ch);
  curl_close($ch);

  return $data;
}



for ($i = 1; $i <= 491; $i++) {

	$_SESSION["eventtarget"] = 'lnkbtnOhmy1';
	$_SESSION["eventargument"] = '';

	if ($i == 1) {
$_SESSION["viewstate"] = "/wEPDwULLTEzNzIwNjY5MDYPZBYCAgMPZBYMAgEPDxYCHgdWaXNpYmxlaGRkAgIPDxYCHwBoZGQCBQ8WAh4LXyFJdGVtQ291bnQCFBYoAgEPZBYEZg8VBQExvAE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9dHM1Y2o1NVZ6U1VTWWpvVkRMTGolMmIlMmJBVnpNenIxakd3MXRjblJnVTBqYlElM2QiIG9uY2xpY2s9ImNvb2tpZUlkKCdEVDloV3QwdlFIN3dna2ZCdktCemF0QW9zVlRCQ0pnU3hidmV4aWhPS3JsUGwxWjVHSkF5Q21IQVg0RUZwSUlqJykiPjEwMyzkuIroqLQsMzIzNDwvYT4oMTZLKQbliKTmsboHMTAzMTIzMQzlpqjlrrPpoqjljJZkAgIPFQEAZAICD2QWBGYPFQUBMsMBPGEgaHJlZj0iY29udGVudDMuYXNweD9wPWFKYiUyZkU5b1ZmZnRKaGR6OG9aOTNPQ0NwTnl4T1U4dlBUYk4lMmZjdm4lMmIlMmZ4VSUzZCIgb25jbGljaz0iY29va2llSWQoJ0o1eXMlMmJXdHBMUzhMNWhhMlRJU2FxU2ZXZVdXRmUxdHlkRXIxbVRkVkJBbG1WJTJiUTFJbUtGaGI3NmJpbkZGaTlTJykiPjEwMyzkuIrmmJMsMjI0MjwvYT4oOUspBuWIpOaxugcxMDMxMjMxBuS+teWNoGQCAg8VAQBkAgMPZBYEZg8VBQEzvgE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9SDJaWW5vUWxzS0ZBZUhoWWxPYWg1WVV3em55ZkZIT2RyWWNVRW9hb3RIVSUzZCIgb25jbGljaz0iY29va2llSWQoJzJtQ3JhR0MlMmIwVXMlMmJBTWdPbldQWUVGcWVHS0glMmZ1a2plRmtKciUyYlgzJTJmWlg4SWxlTFR2eU85cTZPTGd5N3Y0b0o5JykiPjEwMyzogbIsNDM5MzwvYT4oMUspBuijgeWumgcxMDMxMjI3DOS/neitt+euoeadn2QCAg8VAQBkAgQPZBYEZg8VBQE0xAE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9NEExV3NBYmZvQldzQk10bkMlMmI0TWQ2d0NGYUZyMTJvalFibnpyZFJIT2t3JTNkIiBvbmNsaWNrPSJjb29raWVJZCgnSjV5cyUyYld0cExTOEw1aGEyVElTYXFVem5uODglMmZJQSUyZiUyYnRsaFpQNFNYcW85JTJmSElXZUMyV3JUNmxvTmh5ZnNPeEgnKSI+MTAzLOS4iuaYkywyNzEzPC9hPigxOUspBuWIpOaxugcxMDMxMjI3BuipkOasumQCAg8VAQBkAgUPZBYEZg8VBQE1vAE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9cDBMMnZPaXhTR2FLZSUyYnh1dGRWT0syQ2ppbHMyRFJtRVdING9FRWVRMGZjJTNkIiBvbmNsaWNrPSJjb29raWVJZCgnMm1DcmFHQyUyYjBVcyUyYkFNZ09uV1BZRUxWUHlKY3pjVSUyYnoza2p2ZWhHT0VaaFZ5bmh4UGV2azJ2UUk4UHVLMWNWUScpIj4xMDMs6IGyLDQzMjY8L2E+KDFLKQboo4HlrpoHMTAzMTIyNQzkv53orbfnrqHmnZ9kAgIPFQEAZAIGD2QWBGYPFQUBNrwBPGEgaHJlZj0iY29udGVudDMuYXNweD9wPVQ0QXY4ajJ2cTdwbFlRVkRyekhMN2ZPbWxWYUlYOWlUdll3QTBTZm5OUTQlM2QiIG9uY2xpY2s9ImNvb2tpZUlkKCcybUNyYUdDJTJiMFVzJTJiQU1nT25XUFlFQVl0JTJmMkpjTiUyYkZqeTdZMENQeUJtTGFjVTlBaFJNTU0xa3FrZ0swMW82Q1knKSI+MTAzLOiBsiw0MzE2PC9hPigxSykG6KOB5a6aBzEwMzEyMjQM5L+d6K23566h5p2fZAICDxUBAGQCBw9kFgRmDxUFATe7ATxhIGhyZWY9ImNvbnRlbnQzLmFzcHg/cD04cXJGUXJDSUlVa29lMnVmWkZienlFMnZNZVU4aE1xY3glMmZkcGE2TFQ0WGMlM2QiIG9uY2xpY2s9ImNvb2tpZUlkKCdEVDloV3QwdlFIN3dna2ZCdktCemFrR3pqejBVWVVDOFZ2aUpsd212MDclMmZpYlYzS05zV2RueWJIU1FIbFBjbFcnKSI+MTAzLOS4iuiotCwzMzYxPC9hPig2SykG5Yik5rG6BzEwMzEyMjQY5q+S5ZOB5Y2x5a6z6Ziy5Yi25qKd5L6LZAICDxUBAGQCCA9kFgRmDxUFATjEATxhIGhyZWY9ImNvbnRlbnQzLmFzcHg/cD1PWVpqRSUyYlBtNXF2T2loZ0F5bDV4R1RmTWU5JTJiR0dRJTJiNWJZYWpIcnJjUkhnJTNkIiBvbmNsaWNrPSJjb29raWVJZCgnRFQ5aFd0MHZRSDd3Z2tmQnZLQnphbURwVSUyYnhzYnglMmJ2JTJiWld3b1l4aW1RcVZ1STZJMnB6MVhVWWh0RENpMmVjbCcpIj4xMDMs5LiK6Ki0LDI5OTQ8L2E+KDE2SykG5Yik5rG6BzEwMzEyMjQY5q+S5ZOB5Y2x5a6z6Ziy5Yi25qKd5L6LZAICDxUBAGQCCQ9kFgRmDxUFATm7ATxhIGhyZWY9ImNvbnRlbnQzLmFzcHg/cD1lQWZmNERaSFZyaU92JTJmYVlpdEFKY1YzTFVQczhuUFZHRE9rdmlmVDVpWlklM2QiIG9uY2xpY2s9ImNvb2tpZUlkKCdEVDloV3QwdlFIN3dna2ZCdktCemFpN2N2JTJicnB0eUlIUjFzVzA5VnJNaENCeTRaUW01NFVJSGdDdFlZZmxIcksnKSI+MTAzLOS4iuiotCwzNDMxPC9hPig3SykG5Yik5rG6BzEwMzEyMjMY5q+S5ZOB5Y2x5a6z6Ziy5Yi25qKd5L6LZAICDxUBAGQCCg9kFgRmDxUFAjEwuQE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9VkhnWmxvVzQ3S3VWdFljZTN6NzdSWG9qYkZUMHlNZzZkRXd5cVFacHZjbyUzZCIgb25jbGljaz0iY29va2llSWQoJ0o1eXMlMmJXdHBMUzhMNWhhMlRJU2FxV3JmMEVSSzhDVEp3eDJGZ3hNMDVoS0FYNWRiZmNPVXdGdlVCVFRianlvbCcpIj4xMDMs5LiK5piTLDI2NjQ8L2E+KDZLKQbliKTmsboHMTAzMTIyMxjmr5Llk4HljbHlrrPpmLLliLbmop3kvotkAgIPFQEAZAILD2QWBGYPFQUCMTHAATxhIGhyZWY9ImNvbnRlbnQzLmFzcHg/cD1qNWRYUXk0RkxFdWtCSDFybGlSdnp0NkElMmJaSjNVYSUyZnJCalNaQThaQTZLRSUzZCIgb25jbGljaz0iY29va2llSWQoJzJtQ3JhR0MlMmIwVXMlMmJBTWdPbldQWUVEZFZVNGkwM25TSlNSS0xlbjglMmJEZiUyZnlMM3I2Z0ZVTGZsWHZ6RXlRekxRZycpIj4xMDMs6IGyLDQyNjI8L2E+KDVLKQboo4HlrpoHMTAzMTIyMhjogbLoq4vlrprlhbbmh4nln7fooYzliJFkAgIPFQEAZAIMD2QWBGYPFQUCMTK5ATxhIGhyZWY9ImNvbnRlbnQzLmFzcHg/cD1yR3FVZDdjYUdmSlo1aFdLT0tlekVURXhna0FBSHFDTHdCZFBvaUZ0R1pJJTNkIiBvbmNsaWNrPSJjb29raWVJZCgnMm1DcmFHQyUyYjBVcyUyYkFNZ09uV1BZRUszQjFvQTZzUTJMRG5WV0s3NWJHR1dGM2k2SE1zYlFXbk5RYlFZYWhNd1YnKSI+MTAzLOiBsiw0MTc4PC9hPigzMkspBuijgeWumgcxMDMxMjE4GOiBsuiri+WumuWFtuaHieWft+ihjOWIkWQCAg8VAQBkAg0PZBYEZg8VBQIxM78BPGEgaHJlZj0iY29udGVudDMuYXNweD9wPU0zM3pDVU5adnRiZnBHcTliZjV5RVNCaUhLOERYMTZWUk9ob3RadENkVkklM2QiIG9uY2xpY2s9ImNvb2tpZUlkKCdKNXlzJTJiV3RwTFM4TDVoYTJUSVNhcWNJOHUyb3lqdzloQnV3cXJuZCUyZmElMmJUVGh6Sk9TT1pRcyUyYlFCTDJDT3Flam0nKSI+MTAzLOS4iuaYkywxNTY8L2E+KDQ1SykG5Yik5rG6BzEwMzEyMTYG6KmQ5qy6ZAICDxUBAGQCDg9kFgRmDxUFAjE0wQE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9QTVEdlFlT3hCMUpFTURFRmwydTMlMmIyanpaZkdIU3ZubzdWcE1TVTVzWEpvJTNkIiBvbmNsaWNrPSJjb29raWVJZCgnMldwJTJma3NMU1hNUnpnJTJiN3NvcTB6a1ZWa0tkajFNYnZrZVA5NVpvJTJmWUJVY1BFUnBNMEdWRjYlMmJNMFRjbXczZG4lMmYnKSI+MTAzLOaKlywxMjE2PC9hPigxMkspBuijgeWumgcxMDMxMjEzDOiBsuaYjueVsOitsGQCAg8VAQBkAg8PZBYEZg8VBQIxNfUBPGEgaHJlZj0iY29udGVudDMuYXNweD9wPWZpYXFuTEolMmZqN2luQjM2WDBYYU1oQkZDJTJmc1pFQ1BaRUhCNHdUc1lTTiUyZmNieUtlTkFQcWxSUE1uZGZGSndBMEEiIG9uY2xpY2s9ImNvb2tpZUlkKCc5aXJOQm5DT1BnbW10UFVHYm52JTJiNjgydlJ4cWlGck5CbDZGWkY2RDFDS1BvNzcxbjNjampFcGV6MkpFOW9IcUIySXBxJTJiWUJCODJGb2hQa1RBWFZaNUElM2QlM2QnKSI+MTAzLOmHjeS6pOmZhOawkeS4iiw2PC9hPigySykG5Yik5rG6BzEwMzEyMTIM6YGO5aSx5YK35a6zZAICDxUBAGQCEA9kFgRmDxUFAjE28AE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9YkolMmJlNVBUdlZ2NkNhOWU3eDVadE03aUZUOG5pcmRyUjJ2ejljc0dUQ2diNlMzTEZUQVRPQnB6VGk1OEcycThlIiBvbmNsaWNrPSJjb29raWVJZCgnTVlTa08lMmJ5OWpFd0lpdktiZ1N3M0pEdEpCYURBSUhMSTFwRm1tOTdTTlBQdHc0WE11eFJLclcxTHclMmZSYm0lMmJUZmY3aG5VNVh0TE1jUVY2VXA5UmN2bXclM2QlM2QnKSI+MTAzLOS6pOS4iuaYkywzOTY8L2E+KDE0SykG5Yik5rG6BzEwMzEyMTIM6YGO5aSx5YK35a6zZAICDxUBAGQCEQ9kFgRmDxUFAjE36gE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9N213R3QxU0NKejZkVnFkRHpDYWJ1QkJFZGJ2bXc2bENocGIxM3pIMnNVbXdJU05TdVZPRTBpRGxvRWJlTUxBZiIgb25jbGljaz0iY29va2llSWQoJ01ZU2tPJTJieTlqRXdJaXZLYmdTdzNKT0NUUldFUzludUtld2g2VTJWaXM0bDVlUVpybjdqSFpsQW5XMnFRaXJTTWo5SncybHJocVljSkRPSU15MUV4TVElM2QlM2QnKSI+MTAzLOS6pOS4iuaYkyw0Mjc8L2E+KDE1SykG5Yik5rG6BzEwMzEyMTAM6YGO5aSx5YK35a6zZAICDxUBAGQCEg9kFgRmDxUFAjE4wQE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9OE9XYmhrZkFZNDlnNXdKSiUyZiUyYlJCSzFyN0dtMFNXQmNack1SRTJWZSUyZm5ENCUzZCIgb25jbGljaz0iY29va2llSWQoJ0RUOWhXdDB2UUg3d2drZkJ2S0J6YXBZSVglMmJobG9PVnB2UFVxVVV0VFJMd1V6RnRxJTJiMjdYTFlJemFJcTBRNlBnJykiPjEwMyzkuIroqLQsMzAzNDwvYT4oNkspBuWIpOaxugcxMDMxMjEwGOavkuWTgeWNseWus+mYsuWItuaineS+i2QCAg8VAQBkAhMPZBYEZg8VBQIxObwBPGEgaHJlZj0iY29udGVudDMuYXNweD9wPTVsQTZDQWhjNFhLTm81Y1IxNjdyemxodHozbmw0a1JKQ3VBY3NCY3NCVFklM2QiIG9uY2xpY2s9ImNvb2tpZUlkKCdEVDloV3QwdlFIN3dna2ZCdktCemFzTFFmc1hpN2FaVkFKR0hPNW51Zlp5N1VQcEwlMmI0cXA4WWNBMDRITiUyZnlqZycpIj4xMDMs5LiK6Ki0LDI4MTI8L2E+KDYzSykG5Yik5rG6BzEwMzEyMTAY5q+S5ZOB5Y2x5a6z6Ziy5Yi25qKd5L6LZAICDxUBAGQCFA9kFgRmDxUFAjIwvwE8YSBocmVmPSJjb250ZW50My5hc3B4P3A9UFJqVmxTbVBZenFuYVclMmZHR20yVEc5cXFqd3k0TW1wNDFCZDNEU3Q0WHJZJTNkIiBvbmNsaWNrPSJjb29raWVJZCgnSjV5cyUyYld0cExTOEw1aGEyVElTYXFZeWFzeiUyYlBNTlVIdUklMmZoQmx1NVdOUjlyRlFVRzgzS0Q4MHFMWnVNOEdRRicpIj4xMDMs5LiK5piTLDIzNDA8L2E+KDZLKQbliKTmsboHMTAzMTIxMAbnq4rnm5xkAgIPFQEAZAIGDw8WAh8AaGRkAgcPDxYCHwBoZGQCCw8WAh4EVGV4dAUBMWRkWu+dgZ6sgkV3oU95P4FnGgTUKkM=";
	}

	$_SESSION["viewstategenerator"] = '75816AEB';


	if ($i == 1) {
		$_SESSION["eventvalidation"] = "/wEWBQLRvKxfAsa0yu4NAsOp+c4DApfwo64MAt6Sl+QNVGmG5A7nfCjb52kLjzeCGn5ruTs=";
	}

	session_write_close();

	$res = get_data("http://140.119.164.170/RelExp/lawbank/fetch_lawbank.php");

	echo $res;

	break;
}

?>


