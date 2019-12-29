<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/videointelligence/v1beta2/video_intelligence.proto

namespace Google\Cloud\VideoIntelligence\V1beta2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Annotation progress for a single video.
 *
 * Generated from protobuf message <code>google.cloud.videointelligence.v1beta2.VideoAnnotationProgress</code>
 */
class VideoAnnotationProgress extends \Google\Protobuf\Internal\Message
{
    /**
     * Video file location in
     * [Google Cloud Storage](https://cloud.google.com/storage/).
     *
     * Generated from protobuf field <code>string input_uri = 1;</code>
     */
    private $input_uri = '';
    /**
     * Approximate percentage processed thus far.
     * Guaranteed to be 100 when fully processed.
     *
     * Generated from protobuf field <code>int32 progress_percent = 2;</code>
     */
    private $progress_percent = 0;
    /**
     * Time when the request was received.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 3;</code>
     */
    private $start_time = null;
    /**
     * Time of the most recent update.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp update_time = 4;</code>
     */
    private $update_time = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $input_uri
     *           Video file location in
     *           [Google Cloud Storage](https://cloud.google.com/storage/).
     *     @type int $progress_percent
     *           Approximate percentage processed thus far.
     *           Guaranteed to be 100 when fully processed.
     *     @type \Google\Protobuf\Timestamp $start_time
     *           Time when the request was received.
     *     @type \Google\Protobuf\Timestamp $update_time
     *           Time of the most recent update.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Videointelligence\V1Beta2\VideoIntelligence::initOnce();
        parent::__construct($data);
    }

    /**
     * Video file location in
     * [Google Cloud Storage](https://cloud.google.com/storage/).
     *
     * Generated from protobuf field <code>string input_uri = 1;</code>
     * @return string
     */
    public function getInputUri()
    {
        return $this->input_uri;
    }

    /**
     * Video file location in
     * [Google Cloud Storage](https://cloud.google.com/storage/).
     *
     * Generated from protobuf field <code>string input_uri = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setInputUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->input_uri = $var;

        return $this;
    }

    /**
     * Approximate percentage processed thus far.
     * Guaranteed to be 100 when fully processed.
     *
     * Generated from protobuf field <code>int32 progress_percent = 2;</code>
     * @return int
     */
    public function getProgressPercent()
    {
        return $this->progress_percent;
    }

    /**
     * Approximate percentage processed thus far.
     * Guaranteed to be 100 when fully processed.
     *
     * Generated from protobuf field <code>int32 progress_percent = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setProgressPercent($var)
    {
        GPBUtil::checkInt32($var);
        $this->progress_percent = $var;

        return $this;
    }

    /**
     * Time when the request was received.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 3;</code>
     * @return \Google\Protobuf\Timestamp
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Time when the request was received.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 3;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setStartTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->start_time = $var;

        return $this;
    }

    /**
     * Time of the most recent update.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp update_time = 4;</code>
     * @return \Google\Protobuf\Timestamp
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Time of the most recent update.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp update_time = 4;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setUpdateTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->update_time = $var;

        return $this;
    }

}

