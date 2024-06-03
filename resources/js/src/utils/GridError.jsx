import React from "react";
import { Grid } from "react-loader-spinner";

export default function GridError({ message = "An Error Occurred!" }) {
    return (
        <div className="mt-28 py-16 gap-10 flex flex-col items-center justify-center w-full text-red-500">
            <Grid
                visible={true}
                height="80"
                width="80"
                color="rgb(239 68 68)"
                ariaLabel="grid-loading"
                radius="12.5"
                wrapperStyle={{}}
                wrapperClass="grid-wrapper"
            />

            <h1 className="text-3xl p-3">{message}</h1>
            <div className="flex gap-1 items-end justify-center">
                <span className="font-medium text-3xl">404</span>
                <span className="font-light">|</span>
                <span className="text-sm font-light uppercase">
                    Record Not Found!
                </span>
            </div>
        </div>
    );
}
