<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// [START vision_label_detection]
namespace Google\Cloud\Samples\Vision;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

//$path = 'path/to/your/image.jpg'

//$path = '../../images/image1.jpg';


function detect_label($path)
{
    $imageAnnotator = new ImageAnnotatorClient();

    # annotate the image
    $image = file_get_contents($path);
    $response = $imageAnnotator->labelDetection($image);
    $labels = $response->getLabelAnnotations();

    if ($labels) {
        print("Labels:" . PHP_EOL);
        foreach ($labels as $label) {
            print($label->getDescription() . PHP_EOL);
        }
    } else {
        print('No label found' . PHP_EOL);
    }

    $imageAnnotator->close();
}
// [END vision_label_detection]
