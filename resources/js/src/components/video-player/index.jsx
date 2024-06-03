import { useDispatch, useSelector } from "react-redux";
import VideoPlayer from "./VideoPlayer";
import { useEffect } from "react";
import { useParams } from "react-router-dom";
import { fetchVideo } from "../../redux/video/videoSlice";
import BallTriangleLoader from "../../utils/BallTriangleLoader";
import GridError from "../../utils/GridError";

export default function Video() {
    const { id } = useParams();
    const dispatch = useDispatch();
    const { isLoading, isError, error, data } = useSelector(
        (state) => state.video
    );

    useEffect(
        function () {
            dispatch(fetchVideo(id));
        },
        [dispatch]
    );

    if (isLoading) return <BallTriangleLoader message={error} />;

    if (!isLoading && isError) return <GridError message={error} />;

    if (!isLoading && !isError && data) return <VideoPlayer video={data} />;
}
