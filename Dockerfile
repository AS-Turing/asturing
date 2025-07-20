FROM node:18

ENV PATH="/app/node_modules/.bin:$PATH"

WORKDIR /app

COPY . /app

RUN npm install -g pnpm \
    && pnpm install --ignore-scripts

EXPOSE 3000

CMD ["pnpm", "dev"]
