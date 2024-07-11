import React from "react";
import assets from "../../assets";
import { useDispatch, useSelector } from "react-redux";
import { fetchPaginateComments } from "../../redux/comment/commentSlice";
import { Toast } from "../../utils/SwalToast";

export default function CommentPagination({
    links = [],
    lastPageUrl,
    firstPageUrl,
}) {
    const dispatch = useDispatch();

    async function paginationHandler(url) {
        if (url) {
            const result = await dispatch(await fetchPaginateComments(url));
            if (result?.type === "comment/fetchPaginateComments/fulfilled") {
                return;
            }
        }

        Toast.fire({
            text: "This page is currently unavailable!",
            icon: "error",
        });
    }

    const { total, per_page } = useSelector((state) => state.comment.comments);
    console.log(total);

    return (
        <div className="w-full p-2 flex items-center justify-between gap-1 border-b border-solid border-slate-300 pb-3">
            <h2 className="text-2xl font-medium text-slate-400 underline">
                Comments
            </h2>
            {total / per_page > 1 ? (
                <ul className="flex gap-4 bg-white p-2 items-center justify-center border border-solid border-slate-300 shadow-[0px_2px_4px_0px_rgba(0,0,0,0.12)] rounded-md group active">
                    <li
                        onClick={() => paginationHandler(firstPageUrl)}
                        className="border border-green-500 bg-green-100/30 rounded border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200"
                    >
                        {assets.svg.leftArrows(14, 14)}
                    </li>
                    <div className="flex">
                        {links.map(function (link, index) {
                            if (index === 0) {
                                return (
                                    <li
                                        onClick={() =>
                                            paginationHandler(link?.url)
                                        }
                                        key={index}
                                        className="border border-green-500 bg-green-100/30 rounded-tl rounded-bl border-r-0 border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200 cursor-pointer"
                                        style={{
                                            backgroundColor:
                                                link?.active &&
                                                "rgb(34 197 94)",
                                            color: link?.active && "#fff",
                                        }}
                                    >
                                        {assets.svg.leftArrow(13, 13)}
                                    </li>
                                );
                            }

                            if (index === links.length - 1) {
                                return (
                                    <li
                                        onClick={() =>
                                            paginationHandler(link?.url)
                                        }
                                        key={index}
                                        className="border border-green-500 bg-green-100/30 rounded-tr rounded-br border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200 cursor-pointer"
                                        style={{
                                            backgroundColor:
                                                link?.active &&
                                                "rgb(34 197 94)",
                                            color: link?.active && "#fff",
                                        }}
                                    >
                                        {assets.svg.rightArrow(14, 14)}
                                    </li>
                                );
                            }

                            return (
                                <li
                                    onClick={() => paginationHandler(link?.url)}
                                    key={index}
                                    className="border border-green-500 bg-green-100/30 border-r-0 border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200 cursor-pointer"
                                    style={{
                                        backgroundColor:
                                            link?.active && "rgb(34 197 94)",
                                        color: link?.active && "#fff",
                                    }}
                                >
                                    {link?.label}
                                </li>
                            );
                        })}
                    </div>
                    <li
                        onClick={() => paginationHandler(lastPageUrl)}
                        className="border border-green-500 bg-green-100/30 rounded border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200"
                    >
                        {assets.svg.rightArrows(14, 14)}
                    </li>
                </ul>
            ) : (
                <p>---</p>
            )}
        </div>
    );
}
