import InstallationFaqItem from "./InstallationFaqItem";

export default function InstallationFaq() {
    return (
        <div className="relative bg-white bg-gradient-to-tr from-blue-500/10  via-purple-500/10 to-cyan-500/10 overflow-hidden">
            <div className="container flex gap-20 h-full py-10 md:py-20 items-center justify-center flex-col lg:flex-row">
                <div className="w-full relative">
                    <ul className="relative text-lg text-navy font-[450] py-10">
                        <div className="hidden sm:block absolute left-20 top-0 w-px h-full bg-gradient-to-b from-pink-600/5 via-pink-600/40 to-pink-600/5"></div>
                        <div className="hidden sm:block absolute left-20 top-0 w-px h-full bg-gradient-to-b from-pink-600/5 via-pink-600/40 to-pink-600/5 ml-0.5"></div>
                        <div className="hidden sm:block absolute left-20 top-0 w-px h-full bg-gradient-to-b from-pink-600/5 via-pink-600/40 to-pink-600/5 ml-1"></div>
                        <InstallationFaqItem title="Single Sign-On and MFA" />
                        <InstallationFaqItem title="Secure-by-default private networking" />
                        <InstallationFaqItem title="Memory-safe Rust and Go stack" />
                        <InstallationFaqItem title="E2EE with A-grade TLS and WireGuard" />
                        <InstallationFaqItem title="SOC2 attested" />
                    </ul>
                </div>
                <div className="w-full">
                    <p className="pb-5 text-purple-500 font-semibold">
                        READY, SET, GO!
                    </p>
                    <h1 className="text-3xl font-medium text-slate-900 leading-[1.1] text-start">
                        Launch Apps Near Users Speedrun Your App Onto.
                    </h1>
                    <p className="py-5 text-lg font-light text-slate-700 text-start">
                        Fly.io We’ll deploy straight from your source code.
                        You’ll be up and running in just minutes. Learn More
                    </p>
                    <div className="pt-4">
                        <a
                            href="#"
                            className="bg-primary text-slate-200 px-6 py-3 rounded-[35px] border-4 border-primary-outline border-solid capitalize tracking-wide"
                        >
                            get ScreenWave for free
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}
