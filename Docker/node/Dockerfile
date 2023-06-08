FROM node:14

WORKDIR /app

COPY ./node-server/package*.json ./

RUN npm install

COPY ./node-server .

EXPOSE 3000

CMD ["npm", "start"]